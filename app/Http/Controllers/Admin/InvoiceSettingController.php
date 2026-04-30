<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InvoiceSetting;
use App\Models\State;
use Illuminate\Support\Facades\DB;

class InvoiceSettingController extends Controller
{
    // 🔹 Show form
    public function index()
    {
        $setting = InvoiceSetting::first();
        $states = State::all();

        return view('admin.invoice-settings.index', compact('setting', 'states'));
    }

    // 🔹 Save settings
    public function store(Request $request)
    {
        $request->validate([
            'company_name'     => 'required|string|max:255',
            'company_address'  => 'required|string',

            // 🔥 Invoice validation
            'invoice_type'     => 'required|in:serial,random',
            'invoice_serial'   => 'required_if:invoice_type,serial|nullable|integer|min:1',
            'random_length'    => 'required_if:invoice_type,random|nullable|integer|min:4|max:10',
        ]);

        $data = $request->all();

        // 🔥 GST checkbox
        $data['gst_enabled'] = $request->has('gst_enabled');

        // 🔥 Invoice Type Logic (IMPORTANT)
        if ($request->invoice_type === 'random') {
            $data['invoice_serial'] = $data['invoice_serial'] ?? 1; // fallback
        } else {
            $data['invoice_serial'] = $data['invoice_serial'] ?? 1;
            $data['random_length'] = null; // clean unused field
        }

        // 🔥 Logo upload
        if ($request->hasFile('company_logo')) {
            $data['company_logo'] = $request->file('company_logo')->store('company', 'public');
        }

        // 🔥 Ensure single row (id = 1)
        InvoiceSetting::updateOrCreate(
            ['id' => 1],
            $data
        );

        return back()->with('success', 'Invoice & GST settings saved successfully');
    }

    // 🔥 Generate Invoice Number (SAFE VERSION)
    public static function generateInvoiceNumber()
    {
        return DB::transaction(function () {

            $setting = InvoiceSetting::lockForUpdate()->first();

            if (!$setting) {
                return 'INV-00001';
            }

            // 🔥 RANDOM MODE
            if ($setting->isRandom()) {

                $length = $setting->random_length ?? 6;

                $random = strtoupper(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, $length));

                return $setting->invoice_prefix . '-' . $random;
            }

            // 🔥 SERIAL MODE (race-condition safe)
            $currentSerial = $setting->invoice_serial;

            $number = $setting->invoice_prefix . '-' .
                str_pad($currentSerial, 5, '0', STR_PAD_LEFT);

            // increment safely
            $setting->increment('invoice_serial');

            return $number;
        });
    }
}