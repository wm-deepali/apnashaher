<?php
class OTPService {

    public function send($mobile)
    {

        $otp = rand(100000,999999);

        Otp::create([
            'mobile'=>$mobile,
            'otp'=>$otp,
            'expires_at'=>now()->addMinutes(5)
        ]);


        $message="$otp OTP (One Time Password) to verify your Mobile Number at AVH Clicks, Do not share OTP with Anyone Regards Admin AVH Clicks SMS by Web Mingo";
        $dlt_id = '1307172378396554838';
        $pe_id = '1301160576431389865';
        $request_parameter = array(
            'authkey'   => '133780APe3PZcx5850ea44',
            'mobiles'   => $mobile,
            'message'   => urlencode($message),
            'sender'    => 'WMINGO',
            'route'     => '4',
            'country'   => '91',
           // 'unicode'   => '1',
        );
        $url = "http://sms.webmingo.in/api/sendhttp.php?";
        foreach($request_parameter as $key=>$val)
        {
            $url.=$key.'='.$val.'&';
        }
        $url = $url.'DLT_TE_ID='.$dlt_id.'&PE_ID='.$pe_id;
        $url =rtrim($url , "&");
        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            //get response
            $output = curl_exec($ch);
            curl_close($ch);
            return response()->json([
            'success' => true,
            'message' => 'Otp Successfully Send on Your mobile number!',
        ]);
            // return true;
        } catch (\Exception $e) {
            dd($e->getMessage());
        }



    }

}