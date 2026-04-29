<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'payment_id',
        'institute_id',
        'invoice_number',
        'invoice_type',

        'company_name',
        'company_address',
        'company_gstin',

        'customer_name',
        'billing_address',
        'customer_gstin',
        'billing_email',

        'base_amount',
        'cgst',
        'sgst',
        'igst',
        'total',

        'terms_conditions'
    ];

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}