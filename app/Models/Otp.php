<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{
    use HasFactory;
     protected $fillable = [
        'mobile',
        'otp',
        'expires_at',
        'verified'
    ];

    protected $casts = [
        'verified' => 'boolean',
        'expires_at' => 'datetime',
    ];
}
