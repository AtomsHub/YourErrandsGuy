<!DOCTYPE html>
<html>
<head>
    <title>Email Verification - YourErrandsGuy</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background: #ffffff;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        p {
            font-size: 16px;
            line-height: 1.6;
        }
        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #999;
            border-top: 1px solid #eee;
            padding-top: 10px;
        }
        .logo {
            display: block;
            margin: 0 auto 20px;
            max-width: 150px;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="https://yourerrandsguy.com.ng/images/erradsguy.png" alt="YourErrandsGuy Logo" class="logo">

        <h2>Hello {{ $full_name }},</h2>

        <p>You have been registered as a dispatcher for <strong>YourErrandsGuy</strong>.</p>

        <p>Your auto-generated password is: <strong>{{ $password }}</strong></p>

        <p>Please use it to log in and change it to your preferred password immediately.</p>

        <p>Best regards,<br><strong>YourErrandsGuy Team</strong></p>

        <p>Thank you for being part of YourErrandsGuy!</p>

        <div class="footer">
            <p>This is an automated email. Please do not reply to this message.</p>
        </div>
    </div>
</body>
</html>
