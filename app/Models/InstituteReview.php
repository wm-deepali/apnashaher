<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InstituteReview extends Model
{
    protected $fillable = [
        'name',
        'mobile',
        'rating',
        'institute_id',
        'review',
        'otp',
        'mobile_verified',
        'status'
    ];
}
