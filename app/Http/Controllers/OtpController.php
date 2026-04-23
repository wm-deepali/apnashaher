<?php

namespace App\Http\Controllers;

use App\Models\Otp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OtpController extends Controller
{
    public function sendOtp(Request $request)
    {
        $request->validate([
            'mobile' => 'required|digits:10'
        ]);

        $otp = rand(100000,999999);

        Otp::updateOrCreate(
            ['mobile'=>$request->mobile],
            [
                'otp'=>$otp,
                'expires_at'=>now()->addMinutes(5),
                'verified'=>false
            ]
        );
        
        
        $message = "{$otp} is the One Time Password(OTP) to verify your MOB number at Web Mingo, This OTP is Usable only once and is valid for 10 min,PLS DO NOT SHARE THE OTP WITH ANYONE";
        $dlt_id = '1307161465983326774';
        $pe_id  = '1301160576431389865';
        $authkey = '133780AWLy8zZpC690b124aP1';
    
        $params = [
            'authkey' => $authkey,
            'mobiles' => $request->mobile,
            'sender'  => 'WMINGO',
            'message' => urlencode($message),
            'route'   => '4',
            'country' => '91',
            'DLT_TE_ID' => $dlt_id,
            'PE_ID' => $pe_id
        ];

        $url = "http://sms.webmingo.in/api/sendhttp.php?" . http_build_query($params);

        // Send SMS using cURL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
        $output = curl_exec($ch);
        $curl_error = curl_error($ch);
        curl_close($ch);

        

        return response()->json([
            'status'=>true,
            'message'=>'OTP Sent'
        ]);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'mobile'=>'required',
            'otp'=>'required'
        ]);

        $otp = Otp::where('mobile',$request->mobile)
            ->where('otp',$request->otp)
            ->where('expires_at','>',now())
            ->first();

        if(!$otp){
            return response()->json([
                'status'=>false,
                'message'=>'Invalid OTP'
            ]);
        }

        $otp->update(['verified'=>true]);

        return response()->json([
            'status'=>true,
            'message'=>'OTP Verified'
        ]);
    }
}