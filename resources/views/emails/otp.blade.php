<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Your Account - PipFlow AI</title>
</head>
<body style="margin: 0; padding: 0; background-color: #050505; color: #e7e7e7; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;">
    <table align="center" width="100%" cellpadding="0" cellspacing="0" style="max-width: 600px; margin: 40px auto; background-color: #0a0a0a; border: 1px solid #333; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.5);">
        <!-- Header -->
        <tr>
            <td align="center" style="padding: 40px 0 20px 0;">
                <h1 style="color: #fff; font-size: 28px; letter-spacing: -0.5px; margin: 0;">PipFlow <span style="color: #f59e0b;">AI</span></h1>
                <p style="color: #666; font-size: 14px; margin-top: 5px;">Your Intelligent Trading Partner</p>
            </td>
        </tr>

        <!-- Content -->
        <tr>
            <td style="padding: 20px 40px; text-align: center;">
                <p style="color: #d1d1d1; font-size: 18px; line-height: 1.6; margin-bottom: 30px;">
                    Welcome to the future of trading. Please use the verification code below to complete your registration.
                </p>

                <!-- OTP Box -->
                <div style="background: linear-gradient(135deg, #f59e0b20, #000000); border: 1px solid #f59e0b40; border-radius: 12px; padding: 20px; display: inline-block; margin-bottom: 30px;">
                    <span style="display: block; font-size: 36px; font-weight: bold; letter-spacing: 8px; color: #f59e0b; text-align: center;">{{ $otp }}</span>
                </div>

                <p style="color: #888; font-size: 14px; margin-bottom: 40px;">
                    This code will expire in 10 minutes. <br>If you did not request this, please ignore this email.
                </p>
                
                <div style="border-top: 1px solid #222; margin: 20px 0;"></div>
            </td>
        </tr>

        <!-- Footer -->
        <tr>
            <td align="center" style="padding: 20px 40px 40px 40px;">
                <p style="color: #444; font-size: 12px; margin: 0;">
                    &copy; {{ date('Y') }} PipFlow AI. All rights reserved.
                </p>
            </td>
        </tr>
    </table>
</body>
</html>
