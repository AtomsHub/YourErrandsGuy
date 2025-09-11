<!DOCTYPE html>
<html>
<head>
    <title>Order Processing - YourErrandsGuy</title>
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
        }
        .logo {
            display: block;
            margin: 0 auto 20px;
        }
    </style>
</head>
<body>
    <div class="container">

       <img src="https://yourerrandsguy.com.ng/images/erradsguy.png" alt="YourErrandsGuy Logo" class="logo">

        <h2>Hello {{ $user_name ?? 'Customer' }},</h2>

        <p>Your order (Order ID: {{ $order_id }}) is currently <strong>being processed by your Vendor</strong>.</p>

        <h4>Vendor Details:</h4>
        <ul>
            <li><strong>Name:</strong> {{ $provider_name }}</li>
            <li><strong>Address:</strong> {{ $provider_phone_number }}</li>
        </ul>

        <p>Your Vendor is preparing your order and will contact you if needed. You will be notified once it’s ready for delivery.</p>

        <p>Best regards,</p>
        <p><strong>YourErrandsGuy Team</strong></p>

        <div class="footer">
            <p>This is an automated email. Please do not reply to this message.</p>
        </div>
    </div>

    <p>Thank you for using YourErrandsGuy!</p>
</body>
</html>
