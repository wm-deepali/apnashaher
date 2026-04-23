<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InstituteTiming extends Model
{
    protected $fillable = [
        'institute_id',
        'day',
        'open_time',
        'close_time',
        'is_active'
    ];

    public function institute()
    {
        return $this->belongsTo(Institute::class);
    }
}
