<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;

class City extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'state_id',
        'is_registered',
        'is_popular',
        'is_launching',
        'image',
        'meta_title',
        'meta_description'
    ];

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    // Auto-generate slug before save/update
    protected static function booted()
    {
        static::saving(function ($city) {

            // agar launching nahi hai to auto slug
            if (!$city->is_launching) {
                $city->slug = Str::slug($city->name);
            }

            // agar launching hai to admin ka slug use hoga
        });
    }
}