<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageFeature extends Model
{

    protected $casts = [
        'apnashaher_listing' => 'boolean',
        'call_whatsapp_button' => 'boolean',
        'verified_badge' => 'boolean',
        'custom_profile_url' => 'boolean',
        'preferred_institute_badge' => 'boolean',
        'profile_performance_insight' => 'boolean',
        'featured_in_category_listings' => 'boolean',
        'promotional_banner_placement' => 'boolean',
        'ai_profile_description_generator' => 'boolean',
    ];
    protected $fillable = [

        'package_id',
        'apnashaher_listing',
        'search_visibility',
        'contact_display',
        'call_whatsapp_button',
        'profile_editing',
        'verified_badge',
        'custom_profile_url',
        'support_type',
        'courses_programs',
        'profile_performance_insight',
        'featured_in_category_listings',
        'promotional_banner_placement',
        'preferred_institute_badge',
        'ai_profile_description_generator'
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

}