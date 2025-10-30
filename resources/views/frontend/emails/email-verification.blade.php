<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Verify Your Email Address</title>
    <style>
        body {
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
            padding: 0;
            margin: 0;
        }
        .email-container {
            max-width: 600px;
            background-color: #ffffff;
            margin: 40px auto;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 1px solid #eeeeee;
        }
        .header h2 {
            margin: 0;
            color: #333333;
        }
        .content {
            padding: 20px 0;
            color: #555555;
            line-height: 1.6;
        }
        .btn {
            display: inline-block;
            background-color: #000000;
            color: white !important;
            padding: 12px 25px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            margin: 20px 0;
        }
        .footer {
            font-size: 13px;
            color: #999999;
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #eeeeee;
        }
        p.emailname{
            text-transform:capitalize;
        }
        .content img{
            width: 150px;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h2>Verify Your Email Address</h2>
        </div>
        <div class="content">
            <p class="emailname">Hy {{ $user->first_name }},</p>
            <p>Thank you for signing up with Artha Jewelry! To complete your registration, please verify your email address by clicking the button below:</p>

            <a href="{{ $url }}" class="btn">Verify Email</a>

            <p>This link will expire in 1 day for security reasons.</p>
            <p>If you didn’t sign up, you can safely ignore this email.</p>
            <br />
            <p>Thanks,</p>
            <p>Artha Jewelry</p>
            <img src="{{ url('/') }}/front/images/logo.png" alt="Artha Jewels logo">
        <div class="footer">
            &copy; {{ date('Y') }} Artha Jewelry/Artha Jewels. All rights reserved.
        </div>
    </div>
</body>
</html>
