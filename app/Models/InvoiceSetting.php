<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceSetting extends Model
{
    protected $fillable = [

        // 🔹 Company
        'company_name',
        'company_logo',
        'company_address',
        'company_phone',
        'company_gstin',
        'company_state',
        'company_city',
        'company_pincode',

        // 🔹 Invoice
        'invoice_prefix',
        'invoice_serial',
        'invoice_type', // ✅ NEW (serial / random)
        'random_length',
        'terms_conditions',

        // 🔹 GST
        'cgst',
        'sgst',
        'igst',
        'gst_enabled',
    ];

    protected $casts = [
        'gst_enabled' => 'boolean',
        'invoice_serial' => 'integer',
        'random_length' => 'integer',
    ];

    /*
    |--------------------------------------------------------------------------
    | 🔥 Helper Methods (important for clean usage)
    |--------------------------------------------------------------------------
    */

    public function isSerial()
    {
        return $this->invoice_type === 'serial';
    }

    public function isRandom()
    {
        return $this->invoice_type === 'random';
    }

    /*
    |--------------------------------------------------------------------------
    | 🔗 Relations
    |--------------------------------------------------------------------------
    */

    public function state()
    {
        return $this->belongsTo(State::class, 'company_state');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'company_city');
    }
}