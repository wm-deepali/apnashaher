<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InstituteBanner extends Model
{
    protected $fillable = ['institute_id', 'image', 'title', 'link', 'status'];

    public function institute()
    {
        return $this->belongsTo(Institute::class);
    }
}
