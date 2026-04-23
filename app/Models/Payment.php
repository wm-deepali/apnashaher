<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'institute_id',
        'institute_plan_id',
        'order_id',
        'payment_id',
        'amount',
        'method',
        'status',
        'gateway_response'
    ];

    protected $casts = [
        'amount' => 'double',
        'gateway_response' => 'array',
    ];

    public function institute()
    {
        return $this->belongsTo(Institute::class);
    }
    public function instituteplan()
    {
        return $this->belongsTo(InstitutePlan::class, 'institute_plan_id');
    }
}
