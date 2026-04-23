<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MobileOtp extends Model
{
    use HasFactory;

    protected $table = 'mobile_otps'; // your table name

    protected $fillable = [
        'mobile',
        'country_code',
        'otp',
        'verified',
    ];
}