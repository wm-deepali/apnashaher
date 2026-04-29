<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceSetting extends Model
{
    protected $fillable = [

        // Company
        'company_name',
        'company_logo',
        'company_address',
        'company_phone',
        'company_gstin',
        'company_state',
        'company_city',
        'company_pincode',

        // Invoice
        'invoice_prefix',
        'invoice_serial',
        'random_invoice',
        'random_length',
        'terms_conditions',

        // GST
        'cgst',
        'sgst',
        'igst',
        'gst_enabled',
    ];

    protected $casts = [
        'random_invoice' => 'boolean',
        'gst_enabled' => 'boolean',
    ];

    // 🔥 Relations (useful later)
    public function state()
    {
        return $this->belongsTo(State::class, 'company_state');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'company_city');
    }
}