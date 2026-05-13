<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SeoSetting;

class SeoSettingController extends Controller
{
    public function index()
    {
        $pages = [

            'home',

            'about-us',

            'why-apnashaher',

            'career-with-us',

            'blogs',

            'faq',

            'contact-us',

            'all-categories',

            'institute-benefits',

            'list-your-institute',

            'advertise-with-us',

            'price-plans',

            'institute-support',

            'share-your-feedback',

            'report-an-issue',
        ];

        $seoSettings = SeoSetting::get()->keyBy('page_key');

        return view(
            'admin.seo-settings.index',
            compact('pages', 'seoSettings')
        );
    }

    public function update(Request $request)
    {
        $request->validate([

            'page_key' => 'required',

            'meta_title' => 'nullable|string|max:255',

            'meta_description' => 'nullable|string',

            'other_scripts' => 'nullable|string',

        ]);

        SeoSetting::updateOrCreate(

            [
                'page_key' => $request->page_key
            ],

            [
                'meta_title'       => $request->meta_title,

                'meta_description' => $request->meta_description,

                'other_scripts'    => $request->other_scripts,
            ]
        );

        return redirect()
            ->back()
            ->with('success', 'SEO Settings Updated Successfully');
    }
}