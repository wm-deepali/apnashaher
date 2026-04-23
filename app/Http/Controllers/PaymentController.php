<?php

namespace App\Http\Controllers;

use App\Models\InstitutePlan;
use App\Models\Institute;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    protected $appId;
    protected $secretKey;
    protected $envUrl;

    public function __construct(){
        $this->appId = env('CASHFREE_APP_ID');
        $this->secretKey = env('CASHFREE_SECRET_KEY');
        $this->envUrl = env('CASHFREE_ENV') === 'LIVE'
            ? 'https://api.cashfree.com'
            : 'https://sandbox.cashfree.com';
    }

    public function create(Request $request){

        $plan = InstitutePlan::where('institute_id',$request->institute_id)->first();
        if(!$plan || $plan->price==0) return response()->json(['status'=>true,'type'=>'free']);

        $orderId = "ORD".time();

        $payment = Payment::create([
            'institute_id'=>$request->institute_id,
            'institute_plan_id'=>$plan->id,
            'order_id'=>$orderId,
            'amount'=>$plan->price,
            'status'=>'pending'
        ]);

        $customer = Institute::find($request->institute_id);

        $payload = [
    "order_id" => $orderId,
    "order_amount" => (float) $plan->price,
    "order_currency" => "INR",
    "customer_details" => [
        "customer_id" => 'CUST_' . $customer->id,
        "customer_phone" => preg_replace('/[^0-9]/', '', $customer->mobile),
        "customer_email" => $customer->invoice_email ?: "test@example.com"
    ],
    "order_meta" => [
        "return_url" => url("/cashfree-callback?order_id={$orderId}")
    ]
];
        $response = Http::withHeaders([
    'x-client-id'=>$this->appId,
    'x-client-secret'=>$this->secretKey,
    'x-api-version' => '2022-09-01',
    'Content-Type'=>'application/json'
])->post("{$this->envUrl}/pg/orders", $payload);

      $responseJson = $response->json();

// ✅ SUCCESS CASE
if(isset($responseJson['payment_session_id'])){
    return response()->json([
        'status'=>true,
        'payment_session_id'=>$responseJson['payment_session_id']
    ]);
}

// ❌ FAILURE CASE
return response()->json([
    'status'=>false,
    'message'=>'Cashfree order creation failed',
    'cashfree_response'=>$responseJson
]); }

    public function callback(Request $request){

        $orderId = $request->order_id ?? null;
        $paymentId = $request->payment_id ?? null;

        $payment = Payment::where('order_id',$orderId)->first();
        if(!$payment) return response()->json(['status'=>false,'message'=>'Payment not found']);

        $payment->update([
            'payment_id'=>$paymentId,
            'status'=>'paid',
            'payment_method' => $request->payment_method ?? 'Credit Card'
        ]);

        $plan = InstitutePlan::where('institute_id',$payment->institute_id)->first();
        if($plan){
            $plan->update([
                'start_date'=>now(),
                'plan_status'=>'completed',
                'expiry_date'=>now()->addDays(365)
            ]);
        }

        $institute = Institute::where('id',$payment->institute_id)->first();
        if($institute){
            $institute->update([
                'registration_complete'=>true,
                'listing_id'=>'INS' . str_pad($institute->id, 5, '0', STR_PAD_LEFT)
            ]);
        }
        Auth::guard('institute')->login($institute);
        //return response()->json(['status'=>true,'message'=>'Payment successful']);
        return redirect()->route('thank-you')->with([
            'payment_success' => true,
            'listing_id' => $institute->listing_id ?? 'N/A',
            'order_id' => $payment->order_id ?? 'FREE'.time(),
            'payment_method' => $payment->payment_method ?? 'Free Plan',
            'payment_status' => ucfirst($payment->status ?? 'success')
        ]);
    }

    public function freePlanComplete(Request $request){

        $institute = Institute::find($request->institute_id);

        if(!$institute){
            return redirect()->back();
        }
        
        $institute->update([
            'registration_complete'=>true,
            'listing_id'=>'INS' . str_pad($institute->id, 5, '0', STR_PAD_LEFT)
        ]);
        $orderId = 'FREE'.str_pad($institute->id, 5, '0', STR_PAD_LEFT);
        $plan = InstitutePlan::where('institute_id',$request->institute_id)->first();
        $payment = Payment::create([
            'institute_id'=>$request->institute_id,
            'institute_plan_id'=>$plan->id,
            'order_id'=>$orderId,
            'amount'=>0,
            'status'=>'success',
            'payment_method' => 'Free Plan'
        ]);
        Auth::guard('institute')->login($institute);
        return redirect()->route('thank-you')->with([
            'payment_success' => true,
            'listing_id' => $institute->listing_id ?? 'N/A',
            'order_id' => $orderId,
            'payment_method' => 'Free Plan',
            'payment_status' => 'N/A'
        ]);
    }
}