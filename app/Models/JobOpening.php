<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobOpening extends Model
{
    protected $fillable = [
        'job_title',
        'slug',
        'employment_type',
        'job_location',
'job_type',
        'salary_type',
        'salary_fixed',
        'salary_from',
        'salary_to',
        'salary_duration',

        'overview',
        'job_description',
        'eligibility_criteria'
    ];
}