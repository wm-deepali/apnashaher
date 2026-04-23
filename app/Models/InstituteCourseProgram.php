<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InstituteCourseProgram extends Model
{
    protected $fillable = [
        'institute_id',
        'plan_id', // master plans table reference
        'name',
        'detailed_information',
        'duration',
        'duration_unit',
        'mode',
        'image',
        'course_fee',
        'short_desc',
        'available_seats',
        'start_date',
        'thumb_image'
    ];

    public function institute()
    {
        return $this->belongsTo(Institute::class);
    }

    public function plan()
    {
        return $this->belongsTo(Package::class);
    }
}
