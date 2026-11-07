<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>

    <meta charset="UTF-8">

    <title>تسجيل دخول الأدمن</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">

    <style>

        *{
            font-family: Cairo;
        }

        body{

            background: url('/images/image.jpeg') center center;
            background-size: cover;

            height: 100vh;

            display: flex;
            justify-content: center;
            align-items: center;

        }

        .login-card{

            width: 450px;

            background: #fff;

            padding: 40px;

            border-radius: 30px;

            box-shadow: 0 10px 40px rgba(0,0,0,.2);

        }

        .logo{

            width: 170px;

            display: block;

            margin: auto;

        }

        h2{

            text-align: center;

            margin-top: 20px;

            margin-bottom: 30px;

            color: #4a2d15;

        }

        .form-control{

            height: 55px;

            border-radius: 15px;

            margin-bottom: 20px;

        }

        .btn-login{

            width: 100%;

            height: 55px;

            border: none;

            border-radius: 15px;

            background: #4a2d15;

            color: white;

            font-size: 20px;

        }

        .footer{

            text-align: center;

            margin-top: 25px;

            color: #888;

        }

    </style>

</head>

<body>

<div class="login-card">

    <img src="{{ asset('images/logo.png') }}" class="logo">

    <h2>تسجيل دخول الأدمن</h2>
@if (session('error'))

    <div class="alert alert-danger">

        {{ session('error') }}

    </div>

@endif

      <form method="POST" action="{{ route('login.submit') }}">

    @csrf

    <input type="email"
           name="email"
           class="form-control"
           placeholder="البريد الإلكتروني"
           required>

    <input type="password"
           name="password"
           class="form-control"
           placeholder="كلمة المرور"
           required>

    <button type="submit" class="btn-login">
        تسجيل الدخول
    </button>

</form>

    <div class="footer">

        جميع الحقوق محفوظة © مطعم بيت أهلنا

    </div>

</div>

</body>

</html>