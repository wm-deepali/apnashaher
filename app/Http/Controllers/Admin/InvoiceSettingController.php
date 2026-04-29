<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InvoiceSetting;
use App\Models\State;

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
            'company_name' => 'required|string|max:255',
            'company_address' => 'required|string',
            'company_state' => 'required',
            'company_city' => 'required',
            'company_pincode' => 'required',
            'invoice_prefix' => 'required|string|max:10',
        ]);

        $data = $request->all();

        // 🔥 Checkbox handling
        $data['random_invoice'] = $request->has('random_invoice');
        $data['gst_enabled'] = $request->has('gst_enabled');

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

    // 🔥 Generate Invoice Number

    public static function generateInvoiceNumber()
    {
        $setting = \App\Models\InvoiceSetting::first();

        if (!$setting) {
            return 'INV-00001';
        }

        // 🔥 RANDOM MODE
        if ($setting->random_invoice) {

            $length = $setting->random_length ?? 6;

            $random = strtoupper(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, $length));

            return $setting->invoice_prefix . '-' . $random;
        }

        // 🔥 SERIAL MODE
        $number = $setting->invoice_prefix . '-' .
            str_pad($setting->invoice_serial, 5, '0', STR_PAD_LEFT);

        // increment serial safely
        $setting->increment('invoice_serial');

        return $number;
    }
}