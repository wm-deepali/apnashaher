<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InstituteReview;
use App\Models\Institute;
use App\Models\MobileOtp;
use App\Models\InstituteAnalytics;
use App\Models\Enquiry;
use App\Notifications\EnquiryReceivedNotification;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    public function sendOtp(Request $request)
    {
        $request->validate([
            'mobile' => 'required|digits:10',
            'institute_id' => 'required|exists:institutes,id',
        ]);

        // check if mobile already verified for this institute
        $exists = InstituteReview::where('institute_id', $request->institute_id)
                        ->where('mobile', $request->mobile)
                        ->where('mobile_verified', true)
                        ->where(function($query){
                            $query->whereNotNull('review')
                                ->orWhereNotNull('rating'); 
                        })
                        ->exists();
        if ($exists) {
            return response()->json(['message' => 'You have already submitted a review for this institute.'], 400);
        }

        $otp = rand(100000, 999999);
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
        $review = InstituteReview::updateOrCreate(
            [
                'mobile' => $request->mobile,
                'institute_id' => $request->institute_id
            ],
            [
                'mobile' => $request->mobile,
                'institute_id' => $request->institute_id,
                'otp' => $otp,
                'mobile_verified' => false
            ]
        );
        // send OTP via SMS
        // sendOtp($request->mobile, $otp);

        return response()->json([
            'message' => 'OTP sent successfully.',
            'review_id' => $review->id
        ]);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'review_id' => 'required|exists:institute_reviews,id',
            'otp' => 'required|digits:6'
        ]);

        $review = InstituteReview::find($request->review_id);

        if ($review->otp == $request->otp) {
            $review->update([
                'mobile_verified' => true,
            ]);

            return response()->json([
                'message' => 'Mobile verified successfully. You can now submit your review.'
            ]);
        }

        return response()->json([
            'message' => 'Invalid OTP'
        ], 400);
    }

    public function submitReview(Request $request)
    {
        $request->validate([
            'review_id' => 'required|exists:institute_reviews,id',
            'name' => 'required|string|max:255',
            'rating' => 'required|integer|between:1,5',
            'review' => 'required|string|min:10',
        ],[
            'rating.required' => 'Please select a star rating.',
            'rating.integer'  => 'Invalid rating selected.',
            'rating.between'  => 'Please select between 1 to 5 stars.',
        ]);

        $review = InstituteReview::find($request->review_id);

        if (!$review->mobile_verified) {
            return response()->json(['message' => 'Mobile number not verified.'], 400);
        }

        $review->update([
            'name' => $request->name,
            'rating' => $request->rating,
            'review' => $request->review,
            'status' => 'pending'
        ]);
     

         // 🔹 Calculate new average rating
        $avg = InstituteReview::where('institute_id', $review->institute_id)
            ->whereNotNull('rating')       // only completed reviews
            ->avg('rating');               // Laravel returns decimal

        // 🔹 Update institute table
        Institute::where('id', $review->institute_id)
            ->update(['rating' => round($avg, 2)]); // round to 2 decimals
        return response()->json([
            'message' => 'Review submitted successfully.'
        ]);
    }
    public function sendOtpEnquiry(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|digits:10',
            'country_code' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $otp = rand(100000, 999999);
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
        MobileOtp::updateOrCreate(
            [
                'mobile' => $request->mobile,
                'country_code' => $request->country_code,
            ],
            [
                'otp' => $otp,
                'verified' => false
            ]
        );

        return response()->json(['success' => true, 'message' => 'OTP sent successfully']);
    }

    public function verifyOtpEnquiry(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|digits:10',
            'country_code' => 'required|string',
            'otp' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $record = MobileOtp::where([
            'mobile' => $request->mobile,
            'country_code' => $request->country_code,
            'otp' => $request->otp
        ])->first();

        if (!$record) {
            return response()->json(['success' => false, 'message' => 'Invalid OTP']);
        }

        $record->verified = true;
        $record->save();

        return response()->json(['success' => true, 'message' => 'OTP verified successfully']);
    }

    public function submitEnquiry(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'mobile' => 'required|digits:10',
            'country_code' => 'required|string',
            'message' => 'nullable|string',
            'institute_id' => 'required|integer|exists:institutes,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Check if mobile is verified
        $otp = MobileOtp::where([
            'mobile' => $request->mobile,
            'country_code' => $request->country_code,
            'verified' => true
        ])->first();

        if (!$otp) {
            return response()->json(['success' => false, 'message' => 'Mobile number not verified']);
        }

        $enquiry = Enquiry::create([
            'name' => $request->name,
            'institute_id' => $request->institute_id,
            'course_id' => $request->course_id,
            'email' => $request->email,
            'phone' => $request->country_code." ".$request->mobile,
            'message' => $request->message,
        ]);

        // Optional: Delete OTP after success
        $otp->delete();
        // Institute fetch
        $institute = Institute::find($request->institute_id);

        if ($institute) {
            $institute->notify(new EnquiryReceivedNotification($enquiry));
        }
        return response()->json(['success' => true, 'message' => 'Enquiry submitted successfully']);
    }

    public function trackWhatsapp(Request $request)
    {
        InstituteAnalytics::create([
            'institute_id' => $request->institute_id,
            'type' => 'whatsapp',
            'created_at' => now()
        ]);
        $institute = Institute::find($request->institute_id);
        if ($institute) {
            $institute->whatsApp_connect = $institute->whatsApp_connect + 1;
            $institute->save();
        }
        return response()->json(['status' => true]);
    }
    public function trackCall(Request $request)
    {
        InstituteAnalytics::create([
            'institute_id' => $request->institute_id,
            'type' => 'call',
            'created_at' => now()
        ]);
        $institute = Institute::find($request->institute_id);
        if ($institute) {
            $institute->total_calls = $institute->total_calls + 1;
            $institute->save();
        }
        return response()->json(['status' => true]);
    }
}
