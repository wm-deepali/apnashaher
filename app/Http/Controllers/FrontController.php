<?php

namespace App\Http\Controllers;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Faq;
use App\Models\Institute;
use App\Models\Page;
use App\Models\Blog;
use App\Models\Category;
use App\Models\InstituteCourseProgram;
use App\Models\InstituteAnalytics;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\JobOpening;

class FrontController extends Controller
{
    public function home($city = null)
    {
        $data['poppularcities'] = City::where('is_popular', 1)->get();
        $data['categories'] = Category::whereNull('parent_id')->get();

        $data['faqs'] = Faq::where('status', 1)
            ->where('show_on_home', 1)
            ->orderBy('sort_order', 'asc')
            ->get();
        $data['cityslug'] = $city;

        // Featured (based on plan or flag)
        $data['featuredInstitutes'] = Institute::with('latestPlan.plan.features')
            ->whereHas('latestPlan.plan.features', function ($q) {
                $q->where('featured_in_category_listings', true);
            })
            ->latest()
            ->take(8)
            ->get();

        // Popular (based on views)
        $data['popularInstitutes'] = Institute::orderByDesc('views')
            ->take(8)
            ->get();

        // Recent
        $data['recentInstitutes'] = Institute::latest()
            ->take(8)
            ->get();

        return view('front.home', $data);
    }

    public function listyourinstitute()
    {
        $data['states'] = State::where('country_id', 1)->get();
        $data['categories'] = Category::whereNull('parent_id')->get();
        $data['packages'] = Package::orderBy('offered_price', 'asc')->get();
        return view('front.list-your-institute', $data);
    }


    public function faqs()
    {
        $faqs = Faq::where('status', 1)
            ->orderBy('sort_order', 'asc')
            ->get();

        return view('front.faq', compact('faqs'));
    }
    public function plans()
    {
        $data['packages'] = Package::orderBy('offered_price', 'asc')->get();

        // correct guard
        $user = auth('institute')->user();
        $data['currentPlanId'] = $user?->latestPlan?->plan_id ?? null;

        return view('front.plan', $data);
    }

    public function contactus()
    {
        return view('front.contact');
    }

    public function sellerSupports()
    {
        return view('front.help');
    }

    public function aboutus()
    {
        return view('front.about');
    }

    public function explore($city = null)
    {
        $data['cityslug'] = $city;

        return view('front.explore', $data);
    }


    public function listing($categorySlug, $citySlug = null)
    {


        $citySlug = $citySlug ? str_replace('-in-', '', $citySlug) : null;
        $cityslug = $citySlug;

        $selectedSubcategory = Category::where('slug', $categorySlug)
            ->whereNotNull('parent_id') // subcategory
            ->first();

        if ($selectedSubcategory) {
            // It's a subcategory
            $category = Category::findOrFail($selectedSubcategory->parent_id);
        } else {
            // It's a parent category
            $category = Category::where('slug', $categorySlug)
                ->whereNull('parent_id')
                ->firstOrFail();
        }


        $city = $citySlug ? City::where('slug', $citySlug)->first() : null;


        $filteredCategories = Category::withCount('institutes')
            ->whereNull('parent_id') // only parent categories
            ->get();

        $filteredSubcategories = Category::whereNotNull('parent_id')
            ->get()
            ->groupBy('parent_id');


        // Institutes query
        $institutesQuery = Institute::with('category', 'subcategory', 'courses', 'latestPlan')
            ->where('status', 'approved');

        // If subcategory selected → filter by subcategory
        if ($selectedSubcategory) {
            $institutesQuery->where('subcategory_id', $selectedSubcategory->id);
            $institutesQuery->where('category_id', $selectedSubcategory->parent_id);
        } else {
            // else filter by category
            $institutesQuery->where('category_id', $category->id);
        }

        if ($city) {
            $institutesQuery->where('city_id', $city->id);
        }

        $listingInstitutes = $institutesQuery->get()
            ->map(function ($inst) {
                $plan = $inst->latestPlan?->plan;
                $features = $plan?->features;

                $preferred = $features->preferred_institute_badge ?? false;
                $verified = $features->verified_badge ?? false;

                if ($inst->logo) {
                    $logo = asset('storage/' . $inst->logo);
                    $logoType = 'image';
                    $bgColor = null;
                    $textColor = null;
                } else {
                    $logo = strtoupper(substr($inst->name, 0, 1));
                    $logoType = 'letter';
                    $bgColor = pastelColor();
                    $textColor = '#333';
                }

                return [
                    'id' => $inst->id,
                    'name' => $inst->name,
                    'desc' => $inst->description,
                    'location' => $inst->billing_address ?? $inst->city->name ?? '',
                    'verified' => $verified,
                    'preferred' => $preferred,
                    'slug' => $inst->slug,
                    'mobile' => $inst->mobile,
                    'whatsapp' => $inst->whatsapp,
                    'category_id' => $inst->category_id,
                    'category_name' => $inst->category->name ?? '',
                    'subcategory_name' => $inst->subcategory->name ?? '',
                    'subcategory_id' => $inst->subcategory_id ?? null,
                    'logo' => $logo,
                    'logo_type' => $logoType,
                    'logo_bg_color' => $bgColor,
                    'logo_text_color' => $textColor,
                    'courses' => $inst->courses->pluck('name')->toArray(),
                    'amount' => $plan->amount ?? 0,
                    'added' => $inst->created_at->format('Y-m-d'),
                    'views' => $inst->views ?? 0,
                ];
            });

        return view('front.listing', compact(
            'category',
            'city',
            'filteredCategories',
            'filteredSubcategories',
            'listingInstitutes',
            'cityslug',
            'selectedSubcategory'
        ));
    }


    public function advertiseWithUs()
    {
        return view('front.advertise-with-us');
    }

    public function blogs()
    {
        $date['blogs'] = Blog::where('status', 1)->get();
        return view('front.blog', $date);
    }
    public function blogDetails($slug)
    {
        $date['blog'] = Blog::where('slug', $slug)->where('status', 1)->first();
        $date['realted_blogs'] = Blog::where('slug', '!=', $slug)->where('status', 1)->take(6)->get();
        return view('front.blog-details', $date);
    }

    public function details($slug)
    {
        // dd($slug);
        $institute = Institute::with([
            'courses',
            'timings' => function ($query) {
                $query->orderBy('is_active', 'desc'); // active (1) pehle aayenge
            }
        ])->where('slug', $slug)->where('status', 'approved')->first();
        if (!$institute) {
            return redirect()->route('home');
        } else {
            InstituteAnalytics::create([
                'institute_id' => $institute->id,
                'type' => 'view',
                'created_at' => now()
            ]);
            if ($institute) {
                $institute->views = $institute->views + 1;
                $institute->save();
            }
            $verified = $institute->verified; // or is_verified

            return view('front.details', compact('institute', 'verified'));
        }

    }
    public function getcourseById($id)
    {
        // Fetch course by ID
        $course = InstituteCourseProgram::find($id);

        if (!$course) {
            return response()->json([
                'success' => false,
                'message' => 'Course not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'id' => $course->id,
            'name' => $course->name,
            'full_description' => $course->detailed_information, // assuming you have full_description column
            'duration' => $course->duration,
            'duration_unit' => $course->duration_unit,
            'mode' => $course->mode
        ]);
    }
    public function page($slug)
    {
        $date['page'] = Page::where('slug', $slug)->first();
        return view('front.page', $date);
    }

    public function instituteBenifit()
    {
        return view('front.institute-benifit');
    }

    public function termsCondition()
    {
        return view('front.terms-condition');
    }

    public function whyus()
    {
        return view('front.why-us');
    }

    public function jobOpenings()
    {
        $jobs = JobOpening::latest()->get();

        return view('front.career', compact('jobs'));
    }

    public function jobOpeningDetails($slug)
    {
        $job = JobOpening::where('slug', $slug)->firstOrFail();

        return view('front.job-opening-details', compact('job'));
    }

}

