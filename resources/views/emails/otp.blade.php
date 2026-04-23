<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>OTP Verification</title>
</head>
<body style="margin:0; padding:0; background-color:#f4f6f8; font-family: Arial, sans-serif;">

    <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f6f8; padding:20px;">
        <tr>
            <td align="center">

                <!-- Card -->
                <table width="100%" max-width="500" cellpadding="0" cellspacing="0" 
                       style="background:#ffffff; border-radius:10px; overflow:hidden; box-shadow:0 4px 10px rgba(0,0,0,0.05);">

                    <!-- Header -->
                    <tr>
                        <td style="background:linear-gradient(to right, #2563eb, #4f46e5); padding:20px; text-align:center; color:white;">
                            <h2 style="margin:0;">OTP Verification</h2>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding:30px; text-align:center;">

                            <p style="font-size:16px; color:#555; margin-bottom:10px;">
                                Your One-Time Password (OTP) is:
                            </p>

                            <!-- OTP Box -->
                            <div style="font-size:32px; font-weight:bold; color:#2563eb; letter-spacing:6px; margin:20px 0;">
                                {{ $otp }}
                            </div>

                            <p style="font-size:14px; color:#777;">
                                This OTP is valid for <strong>5 minutes</strong>.
                            </p>

                            <p style="font-size:14px; color:#777;">
                                Do not share this OTP with anyone for security reasons.
                            </p>

                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background:#f9fafb; padding:15px; text-align:center; font-size:12px; color:#999;">
                            © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>
</html>