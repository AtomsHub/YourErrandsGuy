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
            color: #333;
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
        h1 {
            color: #00A859; /* Custom color */
        }
        p {
            font-size: 16px;
            line-height: 1.6;
        }
        .code {
            display: inline-block;
            font-size: 20px;
            font-weight: bold;
            background: #f0f0f0;
            padding: 10px 20px;
            margin: 20px 0;
            border-radius: 5px;
            color: #00A859; /* Custom color */
        }
        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #999;
        }
        .logo {
            display: block;
            margin: 0 auto 20px;
        }
        .highlight {
            color: #FDCD11; /* Custom color */
        }
    </style>
</head>
<body>
    <div class="container">
        
        <img src="https://yourerrandsguy.com.ng/images/erradsguy.png" alt="YourErrandsGuy Logo" class="logo"> <!-- Add logo here -->
        <h1>Email Verification</h1>
        <p>Hello,</p>
        <p>Thank you for signing up with <strong>YourErrandsGuy</strong>. Use the code below to verify your email address:</p>
        <div class="code">{{ $code }}</div>
        <p>If you did not request this, please ignore this email or contact our <span class="highlight">support team</span> for assistance.</p>
        <p>Best regards,</p>
        <p><strong>YourErrandsGuy Team</strong></p>
        <div class="footer">
            <p>This is an automated email. Please do not reply to this message.</p>
        </div>
    </div>
</body>
</html>
