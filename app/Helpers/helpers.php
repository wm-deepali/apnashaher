<?php
use App\Models\City;
use App\Models\Category;
use App\Models\Page;
use App\Models\Institute;
use Torann\GeoIP\Facades\GeoIP;

if (!function_exists('topcities')) {
    function topcities()
    {
        $dropcities = City::where('is_launching', 1)->get();

        return $dropcities;
    }
}
if (!function_exists('getmylocation')) {
    function getmylocation()
    {
        try {
            $location = GeoIP::getLocation(); // Facade works when called at runtime
            return $location->city ?? 'Unknown';
        } catch (\Exception $e) {
            return 'Unknown';
        }
    }
}

if (!function_exists('getHomeCategories')) {
    function getHomeCategories()
    {
        return Category::whereNull('parent_id')->select('id', 'name', 'icons', 'slug')
            ->get()
            ->map(function ($cat) {
                return [
                    'id' => $cat->id,
                    'name' => $cat->name,
                    'icon' => $cat->icons,
                    'slug' => $cat->slug,
                ];
            })
            ->toArray();
    }
}

if (!function_exists('getHomeSubcategories')) {
    function getHomeSubcategories()
    {
        $categories = Category::whereNull('parent_id')->with('children')->get();

        $data = [];

        foreach ($categories as $category) {
            // Keep array of names for JS (no JS changes needed)
            $data[$category->id] = $category->children->pluck('name')->toArray();

            // Also create a global PHP array of name → slug mapping
            $slugMap = [];
            foreach ($category->children as $child) {
                $slugMap[$child->name] = $child->slug;
            }
            $data[$category->id . '_slugMap'] = $slugMap;
        }

        return $data;
    }
}

if (!function_exists('footerpages')) {
    function footerpages()
    {
        // Retrieve published pages and pluck title by slug as key=>value
        $pages = Page::where('status', 1)->get(['title', 'slug']);
        return $pages;
    }
}

if (!function_exists('getHomeSeller')) {
    function getHomeSeller()
    {

        $cityId = null;


        $path = request()->path();


        $segments = explode('/', $path);


        $lastSegment = end($segments);


        $citySlug = str_replace('educational-institute-in-', '', $lastSegment);


        $city = City::where('slug', $citySlug)->first();

        if ($city) {
            $cityId = $city->id;
        }


        $query = Institute::with('category', 'subcategory', 'courses', 'latestPlan')
            ->whereHas('latestPlan', function ($q) {
                $q->where('plan_status', 'completed')
                    ->where('expiry_date', '>=', now());
            })
            ->where('status', 'approved');
        if ($cityId) {
            $query->where('city_id', $cityId);
        }

        return $query->get()
            ->map(function ($inst) {
                $plan = $inst->latestPlan->plan ?? null;
                $features = $plan->features ?? null;

                // âœ… Priority logic (scalable)
                $planPriority = 0;
                if ($plan) {
                    $planPriority = $plan->price ?? 0;
                }

                $preferred = $plan && $plan->features && $plan->features->preferred_institute_badge;
                $verified = $plan && $plan->features && $plan->features->verified_badge;

                // âœ… Logo logic
                if ($inst->logo != "") {
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
                    'location' => $inst->profile_address ?? $inst->city->name,
                    'verified' => $verified ?? false,
                    'slug' => $inst->slug,
                    'preferred' => $preferred ?? false,
                    'mobile' => $inst->mobile,
                    'whatsapp' => $inst->whatsapp,
                    'category_id' => $inst->category_id,
                    'category_name' => $inst->category->name ?? '',
                    'subcategory_name' => $inst->subcategory->name ?? '',
                    'logo' => $logo,
                    'logo_bg_color' => $bgColor,
                    'logo_text_color' => $textColor,
                    'logo_type' => $logoType,
                    'courses' => $inst->courses->pluck('name')->toArray(),

                    // ðŸ”¥ IMPORTANT
                    'plan_priority' => $planPriority,
                    'created_at' => $inst->created_at,
                ];
            })
            ->toArray();
    }
}
// Helper function to generate pastel colors
function pastelColor()
{
    $r = rand(127, 255);
    $g = rand(127, 255);
    $b = rand(127, 255);
    return sprintf("#%02X%02X%02X", $r, $g, $b);
}
if (!function_exists('listingCategories')) {
    /**
     * Get all top-level categories with institute counts
     */
    function listingCategories()
    {
        return Category::whereNull('parent_id')
            ->withCount([
                'institutes' => function ($q) {
                    $q->where('status', 'approved');
                }
            ])
            ->get(['id', 'name', 'icons'])
            ->map(function ($cat) {
                return [
                    'id' => $cat->id,
                    'name' => $cat->name,
                    'icon' => $cat->icons,
                    'count' => $cat->institutes_count,
                    'slug' => $cat->slug,
                ];
            })
            ->toArray();
    }
}
if (!function_exists('listingSubcategories')) {
    /**
     * Get all subcategories grouped by parent category
     */
    function listingSubcategories()
    {
        $categories = Category::whereNull('parent_id')->with('children')->get();
        $data = [];

        foreach ($categories as $cat) {
            $data[$cat->id] = $cat->children->map(function ($sub) {
                return [
                    'id' => $sub->id,
                    'name' => $sub->name,
                    'slug' => $sub->slug
                ];
            })->toArray();
        }

        return $data;
    }
}
if (!function_exists('listingInstitutes')) {
    /**
     * Get all approved institutes for listing page
     */
    function listingInstitutes()
    {
        $cityId = null;


        $path = request()->path();


        $segments = explode('/', $path);


        $lastSegment = end($segments);


        $citySlug = str_replace('explore-institutes-in-', '', $lastSegment);


        $city = City::where('slug', $citySlug)->first();

        if ($city) {
            $cityId = $city->id;
        }
        $query = Institute::with('category', 'subcategory', 'courses', 'latestPlan')
            ->whereHas('latestPlan', function ($q) {
                $q->where('plan_status', 'completed')
                    ->where('expiry_date', '>=', now());
            })
            ->where('status', 'approved');
        if ($cityId) {
            $query->where('city_id', $cityId);
        }

        return $query->get()
            ->map(function ($inst) {
                $plan = $inst->latestPlan->plan;
                $features = $plan->features ?? null;

                $preferred = $features?->preferred_institute_badge ?? false;
                $verified = $features?->verified_badge ?? false;

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
                    'location' => $inst->profile_address ?? $inst->city->name,
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
            })
            ->toArray();
    }
}
if (!function_exists('getDreawerCategories')) {
    function getDreawerCategories()
    {
        return $categories = Category::with('children')
            ->whereNull('parent_id')
            ->get();
    }
}