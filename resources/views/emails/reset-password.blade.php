<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Quant AI</title>
    <style>
        body { margin: 0; padding: 0; background-color: #000000; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; color: #ffffff; }
        .container { max-width: 600px; margin: 0 auto; padding: 40px 20px; }
        .header { text-align: center; margin-bottom: 40px; }
        .logo { font-size: 24px; font-weight: bold; color: #ffffff; text-decoration: none; }
        .logo span { color: #f59e0b; }
        .card { background-color: #111111; border: 1px solid #333333; border-radius: 12px; padding: 40px; box-shadow: 0 10px 30px rgba(0,0,0,0.5); }
        .title { font-size: 24px; font-weight: bold; margin-bottom: 15px; color: #ffffff; text-align: center; }
        .text { font-size: 16px; line-height: 1.6; color: #cccccc; margin-bottom: 25px; text-align: center; }
        .button-wrapper { text-align: center; margin: 30px 0; }
        .button { display: inline-block; padding: 14px 30px; background: linear-gradient(135deg, #f59e0b 0%, #b45309 100%); color: #000000; font-weight: bold; text-decoration: none; border-radius: 8px; font-size: 16px; }
        .footer { text-align: center; margin-top: 40px; font-size: 12px; color: #666666; }
        .link { color: #f59e0b; text-decoration: none; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <a href="{{ url('/') }}" class="logo">Quant<span>.ai</span></a>
        </div>
        <div class="card">
            <h1 class="title">Reset Your Password</h1>
            <p class="text">
                We received a request to reset the password for your trading account. Click the button below to secure your account with a new password.
            </p>
            <div class="button-wrapper">
                <a href="{{ $url }}" class="button">Reset Password</a>
            </div>
            <p class="text" style="font-size: 14px;">
                This link will expire in 60 minutes. If you did not request a password reset, no further action is required.
            </p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Quant AI. All rights reserved.<br>
            Automated Institutional Trading
        </div>
    </div>
</body>
</html>
