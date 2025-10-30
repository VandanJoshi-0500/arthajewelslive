<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Welcome To Artha Jewels</title>
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
            <h2>Welcome to Artha Jewels</h2>
        </div>

        <div class="content">
            <p class="emailname">Welcome, {{ $user->first_name }}!</p>
            <p>Thank you for registering on our website. We're excited to have you on board.</p>
            <p>To login again, please click the button below:</p>
            <a href="https://arthajewels.com/login" class="btn">Login</a>

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
