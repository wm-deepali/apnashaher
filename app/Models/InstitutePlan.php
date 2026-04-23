<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstitutePlan extends Model
{
   use HasFactory;
   protected $fillable = [
        'institute_id',
        'plan_id', // master plans table reference
        'price',
        'start_date',
        'plan_status',
        'expiry_date'
    ];

    protected $casts = [
        'price' => 'double',
        'start_date' => 'date',
        'expiry_date' => 'date',
    ];

    // Relationships
    public function institute()
    {
        return $this->belongsTo(Institute::class);
    }

    public function plan()
    {
        return $this->belongsTo(Package::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class, 'institute_plan_id');
    }
}
