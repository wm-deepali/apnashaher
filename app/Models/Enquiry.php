<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    protected $table = 'enquiries';

    protected $fillable = [
        'name',
        'institute_id',
        'course_id',
        'email',
        'phone',
        'message',
    ];

    public function institute()
    {
        return $this->belongsTo(Institute::class, 'institute_id');
    }
    public function course()
    {
        return $this->belongsTo(InstituteCourseProgram::class, 'course_id');
    }
}
