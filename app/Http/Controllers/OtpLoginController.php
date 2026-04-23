<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Institute;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class OtpLoginController extends Controller
{
    public function sendOtp(Request $request)
    {
        $request->validate([
            'mobile' => 'required|digits:10',
        ]);

        $user = Institute::where('mobile', $request->mobile)->first();
        if (!$user) {
            return response()->json(['status' => 'not_found', 'message' => 'Mobile number not found']);
        }

        // Generate OTP
        $otp = rand(100000, 999999);

        $user->login_otp = $otp;
        $user->login_otp_sent_at = Carbon::now();
        $user->save();

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
            'status' => 'success',
            'message' => "OTP sent to +91 {$user->mobile}",
            'otp' => $otp // demo only
        ]);
    }

    // Step 2: Verify OTP
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'mobile' => 'required|digits:10|exists:institutes,mobile',
            'otp' => 'required|digits:6',
        ]);

        $user = Institute::where('mobile', $request->mobile)->first();

        // OTP expired check (5 minutes)
        if (
            !$user->login_otp ||
            !$user->login_otp_sent_at ||
            Carbon::parse($user->login_otp_sent_at)->diffInMinutes(Carbon::now()) > 5
        ) {
            return response()->json([
                'status' => 'error',
                'message' => 'OTP expired. Please request a new OTP.'
            ], 422);
        }

        // OTP match check
        if ($user->login_otp != $request->otp) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid OTP'
            ], 422);
        }

        // OTP valid → login
        Auth::guard('institute')->login($user);

        // Clear OTP
        $user->login_otp = null;
        $user->login_otp_sent_at = null;
        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Login successful',
            'user' => $user
        ]);
    }

    // Optional: Logout
    public function logout(Request $request)
    {
        Auth::guard('institute')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}