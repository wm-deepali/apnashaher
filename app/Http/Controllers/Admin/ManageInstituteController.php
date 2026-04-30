<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\City;
use App\Models\State;
use App\Models\Payment;
use App\Models\Invoice;
use App\Models\Enquiry;
use App\Models\Gallery;
use App\Models\Package;
use App\Models\Category;
use App\Models\Institute;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\InstitutePlan;
use App\Models\InvoiceSetting;
use Illuminate\Validation\Rule;
use App\Models\InstituteReview;
use App\Models\InstituteBanner;
use App\Models\InstituteTiming;
use App\Http\Controllers\Controller;
use App\Models\InstituteCourseProgram;
use Illuminate\Support\Facades\Storage;
use App\Notifications\ListingApprovedNotification;

class ManageInstituteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Institute::with([
            'plans',
            'timings',
            'courses',
            'category',
            'subcategory',
            'leads',
            'galleries'
        ]);

        // 🔍 Filters
        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->subcategory_id) {
            $query->where('subcategory_id', $request->subcategory_id);
        }

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('mobile', 'like', '%' . $request->search . '%')
                    ->orWhere('owner_email', 'like', '%' . $request->search . '%');
            });
        }

        // 📅 Date Range
        if ($request->from && $request->to) {
            $query->whereBetween('created_at', [$request->from, $request->to]);
        }

        $institutes = $query->latest()->paginate(10);

        return view('admin.institute.index', compact('institutes'));
    }

    public function newListings(Request $request)
    {
        $query = Institute::with(['category', 'subcategory', 'latestPlan.plan'])
            ->where('status', 'pending');

        // 🔍 Category
        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        // 🔍 Subcategory
        if ($request->subcategory_id) {
            $query->where('subcategory_id', $request->subcategory_id);
        }

        // 🔍 Subscription (Plan)
        if ($request->package_id) {
            $query->whereHas('latestPlan.plan', function ($q) use ($request) {
                $q->where('id', $request->package_id);
            });
        }

        // 🔍 Search
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('mobile', 'like', '%' . $request->search . '%')
                    ->orWhere('owner_email', 'like', '%' . $request->search . '%');
            });
        }

        // 📅 Date Range
        if ($request->from && $request->to) {
            $query->whereBetween('created_at', [$request->from, $request->to]);
        }

        $institutes = $query->latest()->paginate(10);

        // 🔥 send filters data
        $categories = Category::whereNull('parent_id')->get();
        $packages = Package::all();

        return view('admin.institute.new-listings', compact(
            'institutes',
            'categories',
            'packages'
        ));
    }

    public function publishedListings(Request $request)
    {
        $query = Institute::with([
            'category',
            'subcategory',
            'latestPlan.plan'
        ])->where('status', 'approved');

        // 🔍 Category filter
        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        // 🔍 Subcategory filter
        if ($request->subcategory_id) {
            $query->where('subcategory_id', $request->subcategory_id);
        }

        // 🔍 Subscription (Plan filter)
        if ($request->package_id) {
            $query->whereHas('latestPlan.plan', function ($q) use ($request) {
                $q->where('id', $request->package_id);
            });
        }

        // 🔍 Search (name, mobile, email)
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('mobile', 'like', '%' . $request->search . '%')
                    ->orWhere('owner_email', 'like', '%' . $request->search . '%');
            });
        }

        // 📅 Date Range
        if ($request->from && $request->to) {
            $query->whereBetween('created_at', [
                $request->from . ' 00:00:00',
                $request->to . ' 23:59:59'
            ]);
        }

        $institutes = $query->latest()->paginate(10);

        // 🔥 send for filters
        $categories = Category::whereNull('parent_id')->get();
        $packages = Package::all();

        return view('admin.institute.published-listings', compact(
            'institutes',
            'categories',
            'packages'
        ));
    }

    public function subscriptions(Request $request)
    {
        $query = Payment::with([
            'institute.category',
            'institute.subcategory',
            'instituteplan.plan'
        ]);

        // 🔍 Category
        if ($request->category_id) {
            $query->whereHas('institute', function ($q) use ($request) {
                $q->where('category_id', $request->category_id);
            });
        }

        // 🔍 Subcategory
        if ($request->subcategory_id) {
            $query->whereHas('institute', function ($q) use ($request) {
                $q->where('subcategory_id', $request->subcategory_id);
            });
        }

        // 🔍 Subscription (plan)
        if ($request->package_id) {
            $query->whereHas('instituteplan.plan', function ($q) use ($request) {
                $q->where('id', $request->package_id);
            });
        }

        // 🔍 Payment Status
        if ($request->status) {
            $query->where('status', $request->status);
        }

        // 🔍 Search
        if ($request->search) {
            $query->whereHas('institute', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('mobile', 'like', '%' . $request->search . '%')
                    ->orWhere('owner_email', 'like', '%' . $request->search . '%');
            });
        }

        // 📅 Date Range (FIXED)
        if ($request->from && $request->to) {
            $query->whereBetween('created_at', [
                $request->from . ' 00:00:00',
                $request->to . ' 23:59:59'
            ]);
        }

        $payments = $query->latest()->paginate(10);

        // 🔥 for filters
        $categories = Category::whereNull('parent_id')->get();
        $packages = Package::all();

        return view('admin.institute.subscriptions', compact(
            'payments',
            'categories',
            'packages'
        ));
    }

    public function orderDetail($id)
    {
        $payment = Payment::with([
            'institute.state',
            'institute.city',
            'instituteplan.plan'
        ])->findOrFail($id);

        $invoice = Invoice::where('payment_id', $payment->id)->first();

        return view('admin.institute.order-detail', compact('payment', 'invoice'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createFullForm()
    {
        $states = State::all();
        $categories = Category::whereNull('parent_id')->get();
        $packages = Package::all();
        return view('admin.institute.create', compact('states', 'categories', 'packages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeFullForm(Request $request)
    {

        $request->validate([
            'name' => ['required', 'min:3', 'max:80', 'regex:/^[A-Za-z\s\(\)\.\-&]+$/'],
            'state_id' => 'required',
            'city_id' => 'required',
            'mobile' => ['required', 'digits:10', 'regex:/^[6-9]\d{9}$/', 'unique:institutes,mobile'],
            'category_id' => 'required',
        ], [
            'name.regex' => 'Name can contain only letters and spaces.',
            'mobile.regex' => 'Enter valid Indian mobile number.'
        ]);

        if ($request->plan_id) {
            $package = Package::find($request->plan_id);

            if ($package && $package->offered_price > 0) {
                $request->validate([
                    'transaction_id' => 'required',
                    'payment_method' => 'required',
                ]);
            }
        }
        $slug = Str::slug($request->name);
        $slug = $this->generateUniqueSlug($slug);
        $institute = new Institute();

        $institute->name = $request->name;
        $institute->slug = $slug;
        $institute->country = 'India';
        $institute->listing_id = 'INS' . str_pad($institute->id, 5, '0', STR_PAD_LEFT);
        $institute->state_id = $request->state_id;
        $institute->city_id = $request->city_id;
        $institute->mobile = $request->mobile;
        $institute->mobile_verified = true;
        $institute->registration_complete = true;
        $institute->whatsapp = $request->whatsapp;
        $institute->category_id = $request->category_id;
        $institute->subcategory_id = $request->subcategory_id;
        $institute->description = $request->description;
        $institute->profile_address = $request->profile_address;

        // GST Fields
        if (isset($request->gstCheck)) {
            $institute->gst_invoice = true;
            $institute->gstin = $request->gstin;
            $institute->business_name = $request->business_name;
            $institute->billing_address = $request->billing_address;
            $institute->invoice_email = $request->invoice_email;
        }

        $institute->save();

        $plan = Package::findOrFail($request->plan_id);

        $institutepPlan = new InstitutePlan();
        $institutepPlan->institute_id = $institute->id;
        $institutepPlan->plan_id = $request->plan_id;
        $institutepPlan->price = $plan->offered_price;
        $institutepPlan->start_date = now();
        $institutepPlan->plan_status = 'completed';
        $institutepPlan->expiry_date = now()->addDays(365);
        $institutepPlan->save();

        if ($plan->offered_price > 0) {
            $orderId = "ORD" . time();
        } else {
            $orderId = 'FREE' . str_pad($institute->id, 5, '0', STR_PAD_LEFT);
        }

        $payment = new Payment();
        $payment->institute_id = $institute->id;
        $payment->order_id = $orderId;
        $payment->institute_plan_id = $institutepPlan->id;
        $payment->payment_id = $request->transaction_id ?? null;
        $payment->method = $request->payment_method ?? null;
        $payment->amount = $plan->offered_price;
        $payment->status = "success";
        $payment->save();

        return redirect()
            ->route('admin.manage-institute.index')
            ->with('success', 'Institute Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $institute = Institute::with([
            'courses',
            'timings',
            'payments',
            'category',
            'reviews',
            'subcategory',
            'leads',
            'galleries'
        ])->findOrFail($id);

        $institute->analytics_data = [
            '7' => [
                'calls' => $institute->analytics()
                    ->where('type', 'call')
                    ->where('created_at', '>=', now()->subDays(7))
                    ->count(),

                'whatsapp' => $institute->analytics()
                    ->where('type', 'whatsapp')
                    ->where('created_at', '>=', now()->subDays(7))
                    ->count(),

                'views' => $institute->analytics()
                    ->where('type', 'view')
                    ->where('created_at', '>=', now()->subDays(7))
                    ->count(),
            ],

            '15' => [
                'calls' => $institute->analytics()->where('type', 'call')->where('created_at', '>=', now()->subDays(15))->count(),
                'whatsapp' => $institute->analytics()->where('type', 'whatsapp')->where('created_at', '>=', now()->subDays(15))->count(),
                'views' => $institute->analytics()->where('type', 'view')->where('created_at', '>=', now()->subDays(15))->count(),
            ],

            '30' => [
                'calls' => $institute->analytics()->where('type', 'call')->where('created_at', '>=', now()->subDays(30))->count(),
                'whatsapp' => $institute->analytics()->where('type', 'whatsapp')->where('created_at', '>=', now()->subDays(30))->count(),
                'views' => $institute->analytics()->where('type', 'view')->where('created_at', '>=', now()->subDays(30))->count(),
            ],

            'all' => [
                'calls' => $institute->analytics()->where('type', 'call')->count(),
                'whatsapp' => $institute->analytics()->where('type', 'whatsapp')->count(),
                'views' => $institute->analytics()->where('type', 'view')->count(),
            ],
        ];

        return view('admin.institute.view', compact('institute'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $institute = Institute::with('latestPlan', 'courses')->findOrFail($id);

        $states = State::all();
        $categories = Category::whereNull('parent_id')->get();
        $packages = Package::all();

        // ✅ GST SETTINGS
        $invoiceSetting = InvoiceSetting::first();

        // ✅ COURSES
        $courses = InstituteCourseProgram::where('institute_id', $id)
            ->latest()
            ->get();

        // ✅ GALLERY
        $galleries = Gallery::where('institute_id', $id)
            ->latest()
            ->get();

        // ✅ TIMINGS
        $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

        $timingsFromDB = InstituteTiming::where('institute_id', $id)
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

        $plan = $institute->latestPlan;

        if (!$plan || !$plan->plan) {
            $features = null;
        } else {
            $features = $plan->plan->features;
        }

        // ✅ Course limit
        $limitCourse = $features?->courses_programs ?? 0;
        $instuteCourse = $institute->courses->count() ?? 0;
        $remainingCourses = max($limitCourse - $instuteCourse, 0);

        $banners = InstituteBanner::where('institute_id', $institute->id)->get();

        return view('admin.institute.edit', compact(
            'institute',
            'states',
            'categories',
            'packages',
            'courses',
            'galleries',
            'timings',
            'remainingCourses',
            'banners',
            'invoiceSetting' // 🔥 IMPORTANT
        ));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'min:3', 'max:80', 'regex:/^[A-Za-z\s\(\)\.\-&]+$/'],
            'state_id' => 'required',
            'city_id' => 'required',
            'mobile' => [
                'required',
                'digits:10',
                Rule::unique('institutes', 'mobile')->ignore($id),
            ],
            'category_id' => 'required',
        ], [
            'name.regex' => 'Name can contain only letters and spaces.',
            'mobile.regex' => 'Enter valid Indian mobile number.'
        ]);

        if ($request->plan_id) {
            $package = Package::find($request->plan_id);

            if ($package && $package->offered_price > 0) {
                $request->validate([
                    'transaction_id' => 'required',
                    'payment_method' => 'required',
                ]);
            }
        }

        $institute = Institute::findOrFail($id);

        $institute->name = $request->name;
        $institute->state_id = $request->state_id;
        $institute->city_id = $request->city_id;
        $institute->mobile = $request->mobile;
        $institute->whatsapp = $request->whatsapp;
        $institute->category_id = $request->category_id;
        $institute->subcategory_id = $request->subcategory_id;
        $institute->description = $request->description;
        $institute->profile_address = $request->profile_address;

        // GST update
        if (isset($request->gstCheck)) {
            $institute->gst_invoice = true;
            $institute->gstin = $request->gstin;
            $institute->business_name = $request->business_name;
            $institute->billing_address = $request->billing_address;
            $institute->invoice_email = $request->invoice_email;
        } else {
            $institute->gstin = null;
            $institute->business_name = null;
            $institute->billing_address = null;
            $institute->invoice_email = null;
        }

        $institute->save();

        $institutepPlan = InstitutePlan::findOrFail($request->ins_plan_id);
        $plan = Package::findOrFail($request->plan_id);
        $payment = Payment::findOrFail($request->payment_id);

        if ($request->plan_id != $institutepPlan->plan_id) {
            $institutepPlan->institute_id = $institute->id;
            $institutepPlan->plan_id = $request->plan_id;
            $institutepPlan->price = $plan->offered_price;
            $institutepPlan->save();

            if ($plan->offered_price > 0) {
                $orderId = "ORD" . time();
            } else {
                $orderId = 'FREE' . str_pad($institute->id, 5, '0', STR_PAD_LEFT);
            }
            $payment->institute_id = $institute->id;
            $payment->order_id = $orderId;
            $payment->payment_id = $request->transaction_id ?? null;
            $payment->method = $request->payment_method ?? null;
            $payment->amount = $plan->offered_price;
            $payment->save();
        } else {
            $payment->payment_id = $request->transaction_id ?? null;
            $payment->method = $request->payment_method ?? null;
            $payment->amount = $plan->offered_price;
            $payment->save();
        }

        return redirect()
            ->route('admin.manage-institute.index')
            ->with('success', 'Institute Updated Successfully');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $institute = Institute::findOrFail($id);
        $institute->delete();
        return redirect()->route('admin.manage-institute.index')
            ->with('success', 'Category Deleted Successfully');
    }

    public function approve($id)
    {
        $institute = Institute::findOrFail($id);

        $institute->status = 'approved';
        $institute->approved_date = Carbon::now();

        $institute->save();
        $institute->notify(new ListingApprovedNotification($institute->name));
        return redirect()->back()->with('success', 'Institute approved successfully');
    }

    public function approveReview($id)
    {
        $review = InstituteReview::findOrFail($id);

        $review->status = 'approved';

        $review->save();

        return redirect()->back()->with('success', 'Review approved successfully');
    }


    // courses curd
    public function storeCourse(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'duration' => 'required',
            'duration_unit' => 'required',
            'mode' => 'required',
            'course_fee' => 'required',
            'available_seats' => 'required',
        ]);

        $data = $request->except(['_token']);

        // MAIN IMAGE (optional)
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('courses', 'public');
        }

        // THUMB IMAGE
        if ($request->hasFile('thumb_image')) {
            $data['thumb_image'] = $request->file('thumb_image')->store('courses/thumb', 'public');
        }

        InstituteCourseProgram::create($data);

        return redirect()->back()->with('success', 'Course Added Successfully');
    }

    public function editCourse($id)
    {
        $course = InstituteCourseProgram::findOrFail($id);
        return response()->json($course);
    }

    public function updateCourse(Request $request, $id)
    {

        $course = InstituteCourseProgram::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'duration' => 'required',
            'duration_unit' => 'required',
            'mode' => 'required',
            'course_fee' => 'required',
            'available_seats' => 'required',
            'start_date' => 'required'
        ]);

        $data = $request->all();
        $data = $request->except(['_token']);

        // Image Upload
        if ($request->hasFile('image')) {

            if ($course->image) {
                Storage::delete('public/' . $course->image);
            }

            $data['image'] = $request->file('image')->store('courses', 'public');

        }


        // Thumb Image Upload
        if ($request->hasFile('thumb_image')) {

            if ($course->thumb_image) {
                Storage::delete('public/' . $course->thumb_image);
            }

            $data['thumb_image'] = $request->file('thumb_image')->store('courses/thumb', 'public');

        }

        $course->update($data);

        return redirect()->back()->with('success', 'Course Updated Successfully');

    }

    public function coursedestroy($id)
    {

        $course = InstituteCourseProgram::findOrFail($id);

        if ($course->image) {
            Storage::delete('public/' . $course->image);
        }

        if ($course->thumb_image) {
            Storage::delete('public/' . $course->thumb_image);
        }

        $course->delete();

        return response()->json([
            'success' => true,
            'message' => 'Course Deleted Successfully'
        ]);

    }


    // gallery curd
    public function storeGallery(Request $request)
    {
        $request->validate([
            'images.*' => 'required|image|max:5120'
        ]);

        foreach ($request->file('images') as $image) {

            $path = $image->store('gallery', 'public');

            Gallery::create([
                'institute_id' => $request->institute_id,
                'image' => $path
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Images uploaded successfully'
        ]);
    }

    public function destroyGallery($id)
    {

        $gallery = Gallery::findOrFail($id);
        if ($gallery->image) {
            Storage::delete('public/' . $gallery->image);
        }
        $gallery->delete();

        return response()->json([
            'success' => true
        ]);
    }

    // banner curd
    public function storeBanner(Request $request)
    {
        $request->validate([
            'image' => 'required|image'
        ]);

        $path = $request->file('image')->store('banners', 'public');

        InstituteBanner::create([
            'institute_id' => $request->institute_id,
            'image' => $path,
            'title' => $request->title,
            'link' => $request->link,
        ]);

        return response()->json(['success' => true]);
    }

    public function destroyBanner($id)
    {
        $banner = InstituteBanner::findOrFail($id);

        if ($banner->image) {
            Storage::delete('public/' . $banner->image);
        }

        $banner->delete();

        return response()->json(['success' => true]);
    }

    // timing curd
    public function updateTimings(Request $request)
    {
        $instituteId = $request->institute_id;

        foreach ($request->timings as $day => $data) {

            InstituteTiming::updateOrCreate(
                [
                    'institute_id' => $instituteId,
                    'day' => $day
                ],
                [
                    'open_time' => $data['open_time'] ?? '00:00',
                    'close_time' => $data['close_time'] ?? '00:00',
                    'is_active' => isset($data['is_active']) ? 1 : 0
                ]
            );
        }

        return redirect()->back()->with('success', 'Timings updated successfully');
    }

    public function destroyReview($id)
    {

        $review = InstituteReview::findOrFail($id);

        $instuteId = $review->institute_id;
        $review->delete();
        $avg = InstituteReview::where('institute_id', $instuteId)
            ->whereNotNull('rating')
            ->avg('rating');

        Institute::where('id', $instuteId)
            ->update(['rating' => round($avg, 2)]); // round to 2 decimals   



        return redirect()->back()
            ->with('success', 'Review deleted successfully');

    }
    public function destroyLead($id)
    {

        $lead = Enquiry::findOrFail($id);
        $lead->delete();
        return redirect()->back()
            ->with('success', 'Enquiry deleted successfully');
    }


    public function getCities($state_id)
    {
        return City::where('state_id', $state_id)->get();
    }

    public function getSubcategories($category_id)
    {

        return Category::where('parent_id', $category_id)->get();
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

    public function getProfileData($id)
    {
        $institute = Institute::findOrFail($id);

        return view('admin.institute.profile', compact('institute'))->render();
    }

    public function updateProfile(Request $request)
    {
        $institute = Institute::find($request->id);
        $validated = $request->validate([
            'owner_name' => 'required|string|max:255',
            'designation' => 'required',
            'email' => 'required',
            'email',
            'max:255',
            Rule::unique('institutes', 'owner_email')->ignore($institute->id),
            'established_year' => 'required|integer|min:1900|max:2026',
            'institute_desc' => 'required',
            'website' => 'nullable|url',
            // Social Media Validation
            'facebook_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'youtube_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
        ], [
            'website.url' => 'Please enter a valid website URL (e.g., https://www.xyz.com)',
            'facebook_url.url' => 'Please enter a valid Facebook URL (e.g., https://www.facebook.com/username)',
            'instagram_url.url' => 'Please enter a valid Instagram URL (e.g., https://www.instagram.com/username)',
            'youtube_url.url' => 'Please enter a valid YouTube URL (e.g., https://www.youtube.com/@channelname)',
            'twitter_url.url' => 'Please enter a valid Twitter (X) URL (e.g., https://twitter.com/username)',
        ]);




        if (!$institute) {
            $institute = new Institute();
        }

        $institute->owner_name = $request->owner_name;
        $institute->designation = $request->designation;
        $institute->owner_email = $request->email;
        $institute->established_year = $request->established_year;
        $institute->detailed_information = $request->institute_desc;
        $institute->website = $request->website;
        $institute->facebook_url = $request->facebook_url;
        $institute->instagram_url = $request->instagram_url;
        $institute->youtube_url = $request->youtube_url;
        $institute->twitter_url = $request->twitter_url;

        $institute->save();

        return response()->json([
            'status' => true,
            'message' => 'Saved Successfully'
        ]);
    }


    public function showInvoice($id)
    {
        $invoice = Invoice::with([
            'payment',
            'payment.instituteplan.plan',
        ])->where('payment_id', $id)->firstOrFail();

        $setting = InvoiceSetting::first();

        return view('admin.institute.show-invoice', compact('invoice', 'setting'));
    }

    public function adminUpgradePlan(Request $request)
    {
        $request->validate([
            'institute_id' => 'required',
            'plan_id' => 'required',
            'method' => 'required'
        ]);

        $plan = Package::findOrFail($request->plan_id);

        // ❌ same plan block
        $existingPlan = InstitutePlan::where('institute_id', $request->institute_id)->first();
        if ($existingPlan && $existingPlan->plan_id == $plan->id) {
            return response()->json([
                'status' => false,
                'message' => 'Already on this plan'
            ]);
        }

        // ✅ get institute + settings
        $institute = Institute::findOrFail($request->institute_id);
        $setting = InvoiceSetting::first();

        $base = $plan->offered_price;

        // 🔥 GST calculation (same as PaymentController)
        $sameState = $setting->company_state == $institute->state_id;

        if ($sameState) {
            $cgst = ($base * $setting->cgst) / 100;
            $sgst = ($base * $setting->sgst) / 100;
            $igst = 0;
        } else {
            $cgst = 0;
            $sgst = 0;
            $igst = ($base * $setting->igst) / 100;
        }

        $total = $base + $cgst + $sgst + $igst;

        // ✅ create/update plan
        $institutePlan = InstitutePlan::updateOrCreate(
            ['institute_id' => $request->institute_id],
            [
                'plan_id' => $plan->id,
                'price' => $base,
                'start_date' => now(),
                'expiry_date' => now()->addDays(365),
                'plan_status' => 'completed'
            ]
        );

        // ✅ create payment (ADMIN = success directly)
        $payment = Payment::create([
            'institute_id' => $request->institute_id,
            'institute_plan_id' => $institutePlan->id,
            'order_id' => strtoupper($request->method) . time(),
            'payment_id' => $request->transaction_id ?? null,
            'method' => ucfirst($request->method),
            'amount' => $base,
            'cgst' => $cgst,
            'sgst' => $sgst,
            'igst' => $igst,
            'total' => $total,
            'status' => 'success'
        ]);

        // 🔥 Invoice number
        $invoiceNumber = \App\Http\Controllers\Admin\InvoiceSettingController::generateInvoiceNumber();

        // 🔥 Invoice type
        $invoiceType = $institute->gst_invoice ? 'Tax Invoice' : 'Sale Invoice';

        // 🔥 Billing address
        $billingAddress = $institute->gst_invoice
            ? $institute->billing_address
            : $institute->profile_address;

        // ✅ create invoice (same snapshot logic)
        Invoice::create([
            'payment_id' => $payment->id,
            'institute_id' => $institute->id,

            'invoice_number' => $invoiceNumber,
            'invoice_type' => $invoiceType,

            // company snapshot
            'company_name' => $setting->company_name,
            'company_address' => $setting->company_address,
            'company_gstin' => $setting->company_gstin,
            'billing_email' => $institute->invoice_email ?: "test@example.com",

            // customer snapshot
            'customer_name' => $institute->business_name ?? $institute->name,
            'billing_address' => $billingAddress,
            'customer_gstin' => $institute->gst_invoice ? $institute->gstin : null,

            // pricing
            'base_amount' => $base,
            'cgst' => $cgst,
            'sgst' => $sgst,
            'igst' => $igst,
            'total' => $total,

            'terms_conditions' => $setting->terms_conditions
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Plan upgraded successfully with invoice'
        ]);
    }

}
