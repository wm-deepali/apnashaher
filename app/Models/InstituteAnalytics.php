<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InstituteAnalytics extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'institute_id',
        'type',
        'created_at'
    ];

    public function institute()
    {
        return $this->belongsTo(Institute::class);
    }
}
