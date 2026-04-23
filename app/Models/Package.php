<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{

    protected $fillable = [

        'name',
        'title',
        'mrp',
        'discount_type',
        'discount_value',
        'offered_price',
        'is_popular',
        'validity_days',
        'include_package_id'
    ];

    protected $casts = [
        'is_popular' => 'boolean'
    ];

    public function features()
    {
        return $this->hasOne(PackageFeature::class);
    }

    public function getFormattedOfferedPriceAttribute()
    {
        return floor($this->offered_price) == $this->offered_price
            ? number_format($this->offered_price, 0)
            : number_format($this->offered_price, 2);
    }

    public function getFormattedMrpAttribute()
    {
        return floor($this->mrp) == $this->mrp
            ? number_format($this->mrp, 0)
            : number_format($this->mrp, 2);
    }

}
