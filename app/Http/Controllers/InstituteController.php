<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Institute;
use Carbon\Carbon;
use App\Models\Otp;
use App\Models\InstituteTiming;
use App\Models\InstitutePlan;
use App\Models\State;
use App\Models\City;
use App\Models\InstituteCourseProgram;
use App\Models\InstituteReview;
use App\Models\InstituteBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Models\Gallery;
use App\Models\Enquiry;
use App\Models\Invoice;
use App\Models\InvoiceSetting;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendOtpMail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


class InstituteController extends Controller
{
    public function step1(Request $request)
    {
        $request->validate([
            'name' => ['required', 'min:3', 'max:80', 'regex:/^[A-Za-z\s\(\)\.\-&]+$/'],
            'state' => ['required', 'exists:states,id'],
            'city' => ['required', 'exists:cities,id'],
            'mobile' => ['required', 'digits:10', 'regex:/^[6-9]\d{9}$/'],
            'profile_address' => ['required', 'max:200']
        ], [
            'name.regex' => 'Name can contain only letters and spaces.',
            'mobile.regex' => 'Enter valid Indian mobile number.'
        ]);

        $existing = Institute::where('mobile', $request->mobile)->first();

        if ($existing) {

            // If registration already completed
            if ($existing->registration_complete) {

                return response()->json([
                    'status' => false,
                    'message' => 'Mobile number already registered'
                ]);

            }
            // If registration incomplete → continue
            return response()->json([
                'status' => true,
                'institute_id' => $existing->id,
                'resume' => true
            ]);

        }
        $otpVerified = Otp::where('mobile', $request->mobile)
            ->where('verified', true)
            ->exists();

        if (!$otpVerified) {
            return response()->json([
                'status' => false,
                'message' => 'Mobile not verified'
            ]);
        }

        $slug = Str::slug($request->name);

        $slug = $this->generateUniqueSlug($slug);

        $institute = Institute::create([
            'name' => $request->name,
            'slug' => $slug,
            'country' => 'India',
            'state_id' => $request->state,
            'city_id' => $request->city,
            'profile_address' => $request->profile_address,
            'mobile' => $request->mobile,
            'mobile_verified' => true
        ]);

        return response()->json(['status' => true, 'institute_id' => $institute->id]);
    }

    public function step2(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'institute_id' => ['required', 'exists:institutes,id'],
            'category_id' => ['required', 'exists:categories,id'],
            'subcategory_id' => ['nullable'],
            'description' => ['required', 'max:200'],
            'whatsapp' => ['nullable', 'digits:10', 'regex:/^[6-9]\d{9}$/', 'unique:institutes,whatsapp']
        ]);

        Institute::where('id', $request->institute_id)->update([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'description' => $request->description,
            'whatsapp' => $request->whatsapp
        ]);

        return response()->json(['status' => true]);
    }

    public function step4(Request $request)
    {
        $request->validate([
            'institute_id' => ['required', 'exists:institutes,id'],
            'terms' => ['accepted'],
            'invoice_email' => ['nullable', 'email:rfc,dns'],
            'gstin' => ['nullable', 'regex:/^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[A-Z\d]{1}[Z]{1}[A-Z\d]{1}$/']
        ], [
            'gstin.regex' => 'Enter valid GSTIN number'
        ]);

        $institute = Institute::find($request->institute_id);

        $billingAddress = $request->gst_invoice
            ? $request->billing_address
            : $institute->profile_address;

        $institute->update([
            'gst_invoice' => $request->gst_invoice ? 1 : 0,
            'gstin' => $request->gst_invoice ? $request->gstin : null,
            'business_name' => $request->gst_invoice ? $request->business_name : null,
            'billing_address' => $billingAddress,
            'invoice_email' => $request->invoice_email,
        ]);

        return response()->json(['status' => true]);
    }
    public function profile()
    {
        $institute = Auth::guard('institute')->user();

        if (!$institute) {
            return redirect()->route('home');
        }
        if ($institute->profile_completed) {
            return redirect()->route('institute.dashboard');
        }
        $institute = Institute::where('id', $institute->id)->first();
        $plan = $institute->latestPlan;

        $features = $plan->plan->features ?? null;
        $limitCourse = $features?->courses_programs ?? 0;
        $instuteCourse = $institute->courses->count() ?? 0;
        $remainingCourses = max($limitCourse - $instuteCourse, 0);

        return view('front.insitute.profile', compact('institute', 'remainingCourses'));
    }


    public function dashboard()
    {
        $institute = Auth::guard('institute')->user();

        if (!$institute) {
            return redirect()->route('home');
        }

        $institute = Institute::with('category', 'subcategory', 'latestPlan.plan')
            ->where('id', $institute->id)
            ->first();

        $plan = $institute->latestPlan;

        // ✅ FEATURES SAFE
        $features = $plan?->plan?->features ?? null;

        // ===============================
        // ✅ COURSE LIMIT
        // ===============================
        $limitCourse = $features?->courses_programs ?? 0;
        $instuteCourse = $institute->courses->count() ?? 0;

        $data['remainingCourses'] = max($limitCourse - $instuteCourse, 0);

        // ===============================
        // ✅ MAX PLAN CHECK (YOUR EXISTING)
        // ===============================
        $allPlans = \App\Models\Package::orderByDesc('offered_price')->get();
        $maxPlan = $allPlans->first();

        $currentPlanId = $plan->plan_id ?? null;

        $data['isMaxPlan'] = ($currentPlanId == $maxPlan->id);

        // ===============================
        // ✅ EXPIRY + UPGRADE LOGIC
        // ===============================
        $today = Carbon::now();

        $data['isExpired'] = false;
        $data['isExpiringSoon'] = false;
        $data['canUpgrade'] = false;

        if ($plan && $plan->expiry_date) {

            $expiry = Carbon::parse($plan->expiry_date);

            // ❌ expired
            if ($expiry->lt($today)) {
                $data['isExpired'] = true;
            }

            // ⚠️ expiring in 5 days
            elseif ($expiry->diffInDays($today) <= 5) {
                $data['isExpiringSoon'] = true;
            }
        }

        // ✅ Upgrade logic
        $currentPrice = $plan?->plan?->offered_price ?? 0;

        $hasHigherPlan = \App\Models\Package::where('offered_price', '>', $currentPrice)->exists();

        // 👉 Upgrade allowed only if:
        // - No plan
        // - Free plan
        // - Lower than max plan
        $data['canUpgrade'] = (!$plan || $currentPrice == 0 || $hasHigherPlan);

        // ===============================
        // ✅ STATE / CITY
        // ===============================
        $data['states'] = State::where('country_id', 1)->get();
        $data['cities'] = City::where('state_id', $institute->state_id)->get();

        // ===============================
        // ✅ TIMINGS
        // ===============================
        $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

        $timingsFromDB = InstituteTiming::where('institute_id', $institute->id)
            ->get()
            ->keyBy('day');

        $timings = [];

        foreach ($daysOfWeek as $day) {
            $timings[$day] = $timingsFromDB[$day] ?? (object) [
                'open_time' => '00:00',
                'close_time' => '00:00',
                'is_active' => 0
            ];
        }

        $data['timings'] = $timings;

        // ===============================
        // ✅ OTHER DATA
        // ===============================
        $data['institute'] = $institute;

        $data['courses'] = InstituteCourseProgram::where('institute_id', $institute->id)
            ->latest()
            ->get();

        $data['galleries'] = Gallery::where('institute_id', $institute->id)
            ->latest()
            ->get();

        $data['leads'] = Enquiry::with('course')
            ->where('institute_id', $institute->id)
            ->latest()
            ->get();

        $data['reviews'] = InstituteReview::where('institute_id', $institute->id)
            ->where('status', 'approved')
            ->latest()
            ->get();

        $data['notifications'] = $institute->notifications()->latest()->get();

        $data['banners'] = InstituteBanner::where('institute_id', $institute->id)->get();

        $data['invoices'] = Invoice::with(['payment.instituteplan.plan'])
            ->where('institute_id', $institute->id)
            ->latest()
            ->get();

        return view('front.insitute.dashboard', $data);
    }

    public function saveProfile(Request $request)
    {
        $institute = Auth::guard('institute')->user();
        $validator = Validator::make($request->all(), [

            'owner_name' => 'required|string|max:255',
            'designation' => 'required|string|max:100',
            'email' => 'required',
            'email',
            'max:255',
            Rule::unique('institutes', 'owner_email')->ignore($institute->id),
            'est_year' => 'required|integer|min:1900|max:' . date('Y'),
            'institute_desc' => 'required|string|min:20',
            'website' => 'nullable|url',

            'fb' => 'nullable|url',
            'ig' => 'nullable|url',
            'yt' => 'nullable|url',
            'twitter' => 'nullable|url',

        ], [
            'website.url' => 'Please enter a valid website URL (e.g., https://www.xyz.com)',
            'fb.url' => 'Please enter a valid Facebook URL (e.g., https://www.facebook.com/username)',
            'ig.url' => 'Please enter a valid Instagram URL (e.g., https://www.instagram.com/username)',
            'yt.url' => 'Please enter a valid YouTube URL (e.g., https://www.youtube.com/@channelname)',
            'twitter.url' => 'Please enter a valid Twitter (X) URL (e.g., https://twitter.com/username)',
        ]);

        if ($validator->fails()) {

            return response()->json([
                'errors' => $validator->errors()
            ], 422);

        }
        $institute = Auth::guard('institute')->user();

        if (!$institute) {
            return response()->json([
                'status' => false,
                'message' => 'Please login first'
            ], 401); // 401 Unauthorized is more correct
        }


        $institute->update([
            'owner_name' => $request->owner_name,
            'designation' => $request->designation,
            'owner_email' => $request->email,
            'established_year' => $request->est_year,
            'detailed_information' => $request->institute_desc,
            'website' => $request->website,
            'facebook_url' => $request->fb,
            'instagram_url' => $request->ig,
            'youtube_url' => $request->yt,
            'twitter_url' => $request->twitter,
            'profile_completed' => true,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Profile saved successfully'
        ]);
    }


    /*
    =============================
    2. SAVE COURSES
    =============================
    */

    public function saveCourses(Request $request)
    {

        $validator = Validator::make($request->all(), [

            'courses' => 'required|array|min:1',

            'courses.*.name' => 'required|string|max:255',
            'courses.*.detail' => 'required|string',
            'courses.*.mode' => 'required|in:Online,Offline,Both (Hybrid)',
            'courses.*.duration' => 'nullable',
            'courses.*.duration_unit' => 'nullable|in:Days,Months,Years',
            'courses.*.image' => 'nullable|mimes:jpeg,png,jpg,gif,webp|max:2048',

        ]);

        if ($validator->fails()) {

            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
        $institute = Auth::guard('institute')->user();

        if (!$institute) {
            return response()->json([
                'status' => false,
                'message' => 'Please login first'
            ], 401); // 401 Unauthorized is more correct
        }
        $plan = InstitutePlan::where('institute_id', $institute->id)->first();
        foreach ($request->courses as $index => $course) {

            $imagePath = null;

            if ($request->hasFile("courses.$index.image")) {

                $file = $request->file("courses.$index.image");

                $filename = uniqid() . '_' . $file->getClientOriginalName();

                $imagePath = $file->storeAs('courses', $filename, 'public');

            }
            InstituteCourseProgram::updateOrCreate(

                [
                    'institute_id' => $institute->id,
                    'name' => $course['name'], // unique key
                ],

                [
                    'plan_id' => $plan->plan_id,
                    'detailed_information' => $course['detail'],
                    'duration' => $course['duration'] ?? null,
                    'duration_unit' => $course['duration_unit'] ?? null,
                    'mode' => $course['mode'],
                    'image' => $imagePath,
                    'thumb_image' => $imagePath
                ]
            );

        }

        return response()->json([
            'status' => true,
            'message' => 'Courses saved successfully'
        ]);
    }


    /*
    =============================
    3. SAVE TIMING
    =============================
    */

    public function saveTiming(Request $request)
    {
        //dd($request->all());
        $validator = Validator::make($request->all(), [

            'timings' => 'required|array',

            'timings.*.day' => 'required|string',

            'timings.*.open' => 'nullable|date_format:H:i',

            'timings.*.close' => 'nullable|date_format:H:i',

            'timings.*.active' => 'required|boolean',

        ]);

        if ($validator->fails()) {

            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

        $institute = Auth::guard('institute')->user();

        if (!$institute) {
            return response()->json([
                'status' => false,
                'message' => 'Please login first'
            ], 401); // 401 Unauthorized is more correct
        }

        foreach ($request->timings as $timing) {

            InstituteTiming::updateOrCreate(

                [
                    'institute_id' => $institute->id,
                    'day' => $timing['day']
                ],

                [
                    'open_time' => $timing['open'],
                    'close_time' => $timing['close'],
                    'is_active' => $timing['active']
                ]

            );
        }

        return response()->json([
            'status' => true,
            'message' => 'Timing saved successfully'
        ]);
    }

    public function checkSlug(Request $request)
    {

        $slug = Str::slug($request->slug);

        $exists = Institute::where('slug', $slug)->exists();

        return response()->json([
            'available' => !$exists
        ]);
    }


    public function saveSlug(Request $request)
    {

        $institute = Auth::guard('institute')->user();

        $slug = Str::slug($request->slug);

        $blocked = ['admin', 'login', 'register'];

        if (in_array($slug, $blocked)) {
            return response()->json(['message' => 'This URL is not allowed'], 422);
        }

        if (Institute::where('slug', $slug)->exists()) {
            return response()->json(['message' => 'Slug already taken'], 422);
        }

        $institute->slug = $slug;
        $institute->save();

        return response()->json(['status' => true]);
    }

    public function generateUniqueSlug($slug)
    {
        $originalSlug = $slug;
        $count = 1;

        while (Institute::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }


    public function updateProfile(Request $request, $id)
    {
        $institute = Institute::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:80|regex:/^[A-Za-z\s\(\)\.\-&]+$/',
            'owner_name' => 'required|string|max:255',
            'designation' => 'nullable|string|max:255',
            'established_year' => 'nullable|digits:4',
            'registration_number' => 'nullable|string|max:100',
            'website' => 'nullable|url',

            'short_description' => 'nullable|string|max:500',
            'detail_content' => 'nullable|string',

            'profile_address' => 'required|string',
            'country' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
            'zipcode' => 'required|digits:6',

            'logo' => 'nullable|mimes:jpeg,png,jpg,gif,webp|max:2048',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $request->all();

        // ✅ Logo update (old delete optional)
        if ($request->hasFile('logo')) {

            // delete old logo (recommended)
            if ($institute->logo && \Storage::disk('public')->exists($institute->logo)) {
                \Storage::disk('public')->delete($institute->logo);
            }

            $data['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $institute->update($data);

        return response()->json([
            'status' => true,
            'message' => 'Institute details updated successfully!'
        ]);
    }
    public function socialUpdate(Request $request, $id)
    {
        $institute = Institute::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'facebook_url' => ['nullable', 'url'],
            'linkedin_url' => ['nullable', 'url'],
            'twitter_url' => ['nullable', 'url'],
            'instagram_url' => ['nullable', 'url'],
            'youtube_url' => ['nullable', 'url'],
            'google_url' => ['nullable', 'url'],
        ], [
            '*.url' => 'Please enter a valid URL (e.g., https://www.example.com)',

            'facebook_url.url' => 'Enter valid Facebook URL (https://www.facebook.com/username)',
            'instagram_url.url' => 'Enter valid Instagram URL (https://www.instagram.com/username)',
            'youtube_url.url' => 'Enter valid YouTube URL (https://www.youtube.com/@channel)',
            'twitter_url.url' => 'Enter valid Twitter (X) URL (https://twitter.com/username)',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $institute->update($request->only([
            'facebook_url',
            'linkedin_url',
            'twitter_url',
            'instagram_url',
            'youtube_url',
            'google_url'
        ]));

        return response()->json([
            'status' => true,
            'message' => 'Social media updated successfully'
        ]);
    }
    public function updateTimings(Request $request, $institute_id)
    {
        $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

        // Validation rules
        $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

        $rules = [];
        $messages = [];

        foreach ($daysOfWeek as $day) {
            $rules["timings.$day.open_time"] = 'required';
            $rules["timings.$day.close_time"] = 'required|after_or_equal:timings.' . $day . '.open_time';
            $rules["timings.$day.is_active"] = 'sometimes|boolean';

            // Custom messages
            $messages["timings.$day.open_time.required"] = "$day: Opening time is required.";
            $messages["timings.$day.close_time.required"] = "$day: Closing time is required.";
            $messages["timings.$day.close_time.after_or_equal"] = "$day: Closing time must be after or equal to opening time.";
        }

        $validated = $request->validate($rules);

        foreach ($validated['timings'] as $day => $data) {
            InstituteTiming::updateOrCreate(
                ['institute_id' => $institute_id, 'day' => $day],
                [
                    'open_time' => $data['open_time'],
                    'close_time' => $data['close_time'],
                    'is_active' => isset($data['is_active']) ? 1 : 0
                ]
            );
        }

        return response()->json(['success' => true]);
    }

    public function addNewCourse(Request $request)
    {
        // Validation rules
        $validated = $request->validate([
            'institute_id' => 'required|exists:institutes,id',
            'plan_id' => 'nullable',
            'name' => 'required|string|max:255',
            'detailed_information' => 'nullable|string',
            'duration' => 'required|string|max:50',
            'duration_unit' => 'required|in:Days,Months,Years',
            'mode' => 'required|in:Online,Offline,Both (Hybrid)',
            'thumb_image' => 'nullable|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'course_fee' => 'required|numeric|min:0',
            'short_desc' => 'required|string|max:500',
            'available_seats' => 'nullable|integer|min:0',
            'start_date' => 'nullable|date',
        ]);

        // Handle file upload
        if ($request->hasFile('thumb_image')) {

            $manager = new ImageManager(new Driver());

            $file = $request->file('thumb_image');

            // ✅ 1. Store ORIGINAL image
            $originalPath = $file->store('courses', 'public');
            $validated['image'] = $originalPath;

            // ✅ 2. Create THUMBNAIL (resized)
            $thumbnail = $manager->read($file)
                ->cover(400, 300)   // best for fixed size
                ->toJpeg(80);       // compression

            $thumbPath = 'courses/thumb_' . time() . '.jpg';

            Storage::disk('public')->put($thumbPath, $thumbnail);

            $validated['thumb_image'] = $thumbPath;
        }

        // Create course
        $course = InstituteCourseProgram::create($validated);

        // Return JSON response for AJAX
        return response()->json([
            'success' => true,
            'message' => 'Course added successfully!',
            'course_id' => $course->id
        ]);
    }

    public function editCourse($id)
    {
        $course = InstituteCourseProgram::findOrFail($id);

        return view('front.insitute.edit-modal', compact('course'));
    }

    public function updateCourses(Request $request)
    {
        $course = InstituteCourseProgram::findOrFail($request->id);

        // Validation
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'duration' => 'required',
            'duration_unit' => 'required|in:Days,Months,Years',
            'course_fee' => 'required|numeric|min:0',
            'mode' => 'required|in:Online,Offline,Both (Hybrid)',
            'start_date' => 'nullable|date',
            'available_seats' => 'nullable|integer|min:1',
            'short_desc' => 'required|string',
            'detailed_information' => 'nullable|string',
            'thumb_image' => 'nullable|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        try {

            // Image Upload
            if ($request->hasFile('thumb_image')) {
                $manager = new ImageManager(new Driver());


                if ($course->image && Storage::disk('public')->exists($course->image)) {
                    Storage::disk('public')->delete($course->image);
                }

                if ($course->thumb_image && Storage::disk('public')->exists($course->thumb_image)) {
                    Storage::disk('public')->delete($course->thumb_image);
                }


                $file = $request->file('thumb_image');

                // ✅ 1. Store ORIGINAL image
                $originalPath = $file->store('courses', 'public');
                $validated['image'] = $originalPath;

                // ✅ 2. Create THUMBNAIL (resized)
                $thumbnail = $manager->read($file)
                    ->cover(400, 300)   // best for fixed size
                    ->toJpeg(80);       // compression

                $thumbPath = 'courses/thumb_' . time() . '.jpg';

                Storage::disk('public')->put($thumbPath, $thumbnail);

                $validated['thumb_image'] = $thumbPath;
            }

            // Update Course
            $course->update($validated);

            // JSON Response (for AJAX)
            return response()->json([
                'success' => true,
                'message' => 'Course updated successfully'
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage() // optional (remove in production)
            ], 500);
        }
    }
    public function destroyCourses($id)
    {
        $course = InstituteCourseProgram::findOrFail($id);
        if ($course->image && Storage::disk('public')->exists($course->image)) {
            Storage::disk('public')->delete($course->image);
        }

        if ($course->thumb_image && Storage::disk('public')->exists($course->thumb_image)) {
            Storage::disk('public')->delete($course->thumb_image);
        }
        $course->delete();

        return response()->json([
            'success' => true
        ]);
    }
    public function storegallery(Request $request)
    {
        // ✅ Validate
        $request->validate([
            'images' => 'required|array|max:10',
            'images.*' => 'required|mimetypes:image/jpeg,image/png,image/webp,image/avif|max:5120',
        ]);


        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {

                $path = $file->store('gallery', 'public');

                Gallery::create([
                    'image' => $path,
                    'institute_id' => Auth::guard('institute')->user()->id
                ]);
            }
        }

        return response()->json([
            'status' => true,
            'message' => 'Images uploaded successfully!'
        ]);
    }

    public function destroyGallery($id)
    {
        $image = Gallery::findOrFail($id);

        // Delete file from storage
        if (\Storage::disk('public')->exists($image->image)) {
            \Storage::disk('public')->delete($image->image);
        }

        // Delete from database
        $image->delete();

        return response()->json([
            'status' => true,
            'message' => 'Image deleted successfully!'
        ]);
    }

    public function sendOtpRequest(Request $request)
    {
        $request->validate([
            'value' => 'required'
        ]);


        $type = $request->type;
        $value = $request->value;

        // 🔥 UNIQUE CHECK
        if ($type == 'email') {
            $request->validate([
                'value' => [
                    'required',
                    'email',
                    Rule::unique('institutes', 'owner_email')
                        ->ignore(Auth::guard('institute')->id())
                ]
            ], [
                'value.unique' => 'This email is already in use.'
            ]);
        }

        if ($type == 'mobile') {
            $request->validate([
                'value' => [
                    'required',
                    'digits:10',
                    Rule::unique('institutes', 'mobile')
                        ->ignore(Auth::guard('institute')->id())
                ]
            ], [
                'value.unique' => 'This mobile number already exists.'
            ]);
        }

        if ($type == 'whatsapp') {
            $request->validate([
                'value' => [
                    'required',
                    'digits:10',
                    Rule::unique('institutes', 'whatsapp')
                        ->ignore(Auth::guard('institute')->id())
                ]
            ], [
                'value.unique' => 'This mobile number already exists.'
            ]);
        }


        $otp = rand(1000, 9999);

        Session::put('otp', $otp);
        Session::put('update_type', $request->type);
        Session::put('new_value', $request->value);
        Session::put('otp_time', now());
        if ($request->type == 'email') {
            Mail::to($request->value)->send(new SendOtpMail($otp));
        } else {
            $message = "{$otp} is the One Time Password(OTP) to verify your MOB number at Web Mingo, This OTP is Usable only once and is valid for 10 min,PLS DO NOT SHARE THE OTP WITH ANYONE";
            $dlt_id = '1307161465983326774';
            $pe_id = '1301160576431389865';
            $authkey = '133780AWLy8zZpC690b124aP1';

            $params = [
                'authkey' => $authkey,
                'mobiles' => $request->mobile,
                'sender' => 'WMINGO',
                'message' => urlencode($message),
                'route' => '4',
                'country' => '91',
                'DLT_TE_ID' => $dlt_id,
                'PE_ID' => $pe_id
            ];

            $url = "http://sms.webmingo.in/api/sendhttp.php?" . http_build_query($params);

            // Send SMS using cURL
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            $output = curl_exec($ch);
            $curl_error = curl_error($ch);
            curl_close($ch);
        }


        return response()->json([
            'success' => true,
            //'otp' => $otp // remove in production
        ]);
    }

    public function verifyAndUpdate(Request $request)
    {
        if ($request->otp != Session::get('otp')) {
            return response()->json(['success' => false, 'message' => 'Invalid OTP']);
        }
        if (now()->diffInMinutes(Session::get('otp_time')) > 5) {
            return response()->json([
                'success' => false,
                'message' => 'OTP expired'
            ]);
        }

        $type = Session::get('update_type');
        $value = Session::get('new_value');

        $institute = Auth::guard('institute')->user();

        if ($type == 'mobile')
            $institute->mobile = $value;
        if ($type == 'whatsapp')
            $institute->whatsapp = $value;
        if ($type == 'email')
            $institute->owner_email = $value;

        $institute->save();

        return response()->json([
            'success' => true,
            'type' => $type,
            'value' => $value
        ]);
    }

    public function markAsRead($id)
    {
        $institute = Auth::guard('institute')->user();
        $notification = $institute->notifications()->where('id', $id)->first();

        if ($notification && !$notification->read_at) {
            $notification->markAsRead();
        }

        return response()->json(['success' => true]);
    }


    public function storeBanners(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:2048'
        ]);

        $path = $request->file('image')->store('banners', 'public');

        InstituteBanner::create([
            'institute_id' => $request->institute_id,
            'image' => $path,
            'title' => $request->title,
            'link' => $request->link,
        ]);

        return response()->json(['message' => 'Banner uploaded successfully']);
    }

    public function destroyBanners($id)
    {
        $banner = InstituteBanner::findOrFail($id);

        if ($banner->image) {
            Storage::delete('public/' . $banner->image);
        }

        $banner->delete();

        return response()->json(['message' => 'Banner deleted']);
    }

    public function showInvoice($id)
    {
        $invoice = Invoice::with([
            'payment',
            'payment.institute',
            'payment.instituteplan.plan'
        ])->where('payment_id', $id)->firstOrFail();

        $setting = InvoiceSetting::first();

        return view('admin.institute.show-invoice', compact('invoice', 'setting'));
    }

}
