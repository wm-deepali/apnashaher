<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;
use App\Models\PackageFeature;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::latest()->paginate(10);
        return view('admin.packages.index', compact('packages'));
    }

    public function create()
    {
        $packages = Package::all();
        return view('admin.packages.create',compact('packages'));
    }

    public function store(Request $request)
    {
        $request->validate([

            'name' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',

            'mrp' => 'nullable|numeric|min:0',
            'discount_type' => 'nullable|in:flat,percentage',
            'discount_value' => 'nullable|numeric|min:0',
            'offered_price' => 'nullable|numeric|min:0',

            'validity_days' => 'required|integer|min:1',

            'search_visibility' => 'required|in:limited,improved,top',
            //'contact_display' => 'required|in:basic,full',
            'profile_editing' => 'required|in:basic,advance',
            //'support_type' => 'required|in:email,whatsapp,priority',

            'apnashaher_listing' => 'nullable|boolean',
            //'call_whatsapp_button' => 'nullable|boolean',
            'verified_badge' => 'nullable|boolean',
            'custom_profile_url' => 'nullable|boolean',

            'profile_performance_insight' => 'nullable|boolean',
            'featured_in_category_listings' => 'nullable|boolean',
            'promotional_banner_placement' => 'nullable|boolean',
            'preferred_institute_badge' => 'nullable|boolean',

            'is_popular' => 'nullable|boolean',
            'courses_programs' => 'nullable|integer',

        ]);


        $package = Package::create([

            'name' => $request->name,
            'title' => $request->title,

            'mrp' => $request->mrp,
            'discount_type' => $request->discount_type,
            'discount_value' => $request->discount_value,
            'offered_price' => $request->offered_price,

            'is_popular' => $request->is_popular ?? 0,

            'validity_days' => $request->validity_days

        ]);


        PackageFeature::create([

            'package_id' => $package->id,

            'apnashaher_listing' => $request->apnashaher_listing ?? 0,

            'search_visibility' => $request->search_visibility,

            'contact_display' => $request->contact_display ?? NULL,

            'call_whatsapp_button' => $request->call_whatsapp_button ?? 0,

            'profile_editing' => $request->profile_editing,
            'courses_programs' => $request->courses_programs,

            'verified_badge' => $request->verified_badge ?? 0,

            'custom_profile_url' => $request->custom_profile_url ?? 0,
            'profile_performance_insight' => $request->profile_performance_insight ?? 0,
            'featured_in_category_listings' => $request->featured_in_category_listings ?? 0,
            'promotional_banner_placement' => $request->promotional_banner_placement ?? 0,
            'preferred_institute_badge' => $request->preferred_institute_badge ?? 0,
            'ai_profile_description_generator' => $request->ai_profile_description_generator ?? 0,


            'support_type' => $request->support_type

        ]);


         return redirect()->route('admin.manage-packages.index')->with('success', 'Package created successfully.');
    }

    public function edit($id)
    {
        $package = Package::with('features')->findOrFail($id);

        $packages = Package::where('id','!=',$id)->get();

        return view('admin.packages.edit',compact('package','packages'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([

            'name' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',

            'mrp' => 'nullable|numeric|min:0',
            'discount_type' => 'nullable|in:flat,percentage',
            'discount_value' => 'nullable|numeric|min:0',
            'offered_price' => 'nullable|numeric|min:0',

            'validity_days' => 'required|integer|min:1',

            'search_visibility' => 'required|in:limited,improved,top',
            //'contact_display' => 'required|in:basic,full',
            'profile_editing' => 'required|in:basic,advance',
            //'support_type' => 'required|in:email,whatsapp,priority',
            'profile_performance_insight' => 'nullable|boolean',
            'featured_in_category_listings' => 'nullable|boolean',
            'promotional_banner_placement' => 'nullable|boolean',
            'preferred_institute_badge' => 'nullable|boolean',

            'is_popular' => 'nullable|boolean',
            'courses_programs' => 'nullable|integer',

        ]);


        $package = Package::findOrFail($id);


        $package->update([

            'name' => $request->name,
            'title' => $request->title,

            'mrp' => $request->mrp,
            'discount_type' => $request->discount_type,
            'discount_value' => $request->discount_value,
            'offered_price' => $request->offered_price,

            'is_popular' => $request->is_popular ?? 0,

            'validity_days' => $request->validity_days

        ]);


        PackageFeature::updateOrCreate(

            ['package_id'=>$package->id],

            [

                'apnashaher_listing'=>$request->apnashaher_listing ?? 0,

                'search_visibility'=>$request->search_visibility,

                'contact_display'=>$request->contact_display ?? NULL,

                'call_whatsapp_button'=>$request->call_whatsapp_button ?? 0,

                'profile_editing'=>$request->profile_editing,
                'courses_programs' => $request->courses_programs,

                'verified_badge'=>$request->verified_badge ?? 0,

                'custom_profile_url'=>$request->custom_profile_url ?? 0,

                'profile_performance_insight' => $request->profile_performance_insight ?? 0,
                'featured_in_category_listings' => $request->featured_in_category_listings ?? 0,
                'promotional_banner_placement' => $request->promotional_banner_placement ?? 0,
                'preferred_institute_badge' => $request->preferred_institute_badge ?? 0,
                'ai_profile_description_generator' => $request->ai_profile_description_generator ?? 0,

                'support_type'=>$request->support_type

            ]

        );


         return redirect()->route('admin.manage-packages.index')->with('success', 'Package updated successfully.');

    }

    public function destroy($id)
    {

        $package = Package::findOrFail($id);

        PackageFeature::where('package_id',$package->id)->delete();

        $package->delete();

         return redirect()->route('admin.manage-packages.index')->with('success', 'Package deleted successfully.');

    }
    public function getPackageFeatures($id)
    {
        $package = Package::with('features')->findOrFail($id);
        return response()->json($package->features);
    }
}