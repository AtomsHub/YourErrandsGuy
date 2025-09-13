<!DOCTYPE html>
<html>
<head>
    <title>Account Approval - YourErrandsGuy</title>
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
        .highlight {
            background: #f1f7ff;
            padding: 10px;
            border-left: 4px solid #007bff;
            border-radius: 4px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="https://yourerrandsguy.com.ng/images/erradsguy.png" alt="YourErrandsGuy Logo" class="logo">

        <h2>Hello {{ $full_name }},</h2>

        <p>Congratulations! 🎉 Your account as a <strong>Dispatch Rider</strong> with <strong>YourErrandsGuy</strong> has been <span style="color:green; font-weight:bold;">approved</span>.</p>

        <p class="highlight">You can now log in to your dashboard and start accepting delivery requests.</p>

        <p>For your security, please remember to <strong>change your password</strong> if you have not already done so.</p>

        <p>We’re excited to have you on board and look forward to working with you to deliver excellence to our customers.</p>

        <p>Best regards,<br><strong>YourErrandsGuy Team</strong></p>

        <div class="footer">
            <p>This is an automated email. Please do not reply to this message.</p>
        </div>
    </div>
</body>
</html>
