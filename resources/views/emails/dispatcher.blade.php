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
        }
        .logo {
            display: block;
            margin: 0 auto 20px;
        }

    </style>
</head>
<body>
    <div class="container">


        <!--<img src=" {{  asset('images/logo.png')}} " alt="YourErrandsGuy Logo" class="logo">   Add logo here -->

        <h2>Hello, {{ $full_name }}</h2>

       <p>You have been registered as a dispatcher for Your Errands Guy. Your Auto Generated Password is  {{ $password }}.
        Log in with it and change it to your desired password.
       </p>

       <p>Best regards,</p>
        <p><strong>YourErrandsGuy Team</strong></p>
        <div class="footer">
            <p>This is an automated email. Please do not reply to this message.</p>
        </div>
    </div>


    <p>Thank you for using YourErrandsGuy!</p>
</body>
</html>
