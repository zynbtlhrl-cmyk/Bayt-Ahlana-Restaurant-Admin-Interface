<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>

    <meta charset="UTF-8">

    <title>{{ $setting->restaurant_name ?? 'بيت أهلنا' }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">

    <style>

        *{
            font-family: 'Cairo', sans-serif;
        }

        body{
            margin:0;
            background:#f5f6fa;
        }

        .sidebar{
            position: fixed;
            right: 0;
            top: 0;
            width: 260px;
            height: 100vh;
            background: #0d1b3e;
            color: #fff;
            padding-top: 20px;
        }

        .sidebar h3{
            text-align: center;
            margin-bottom: 30px;
        }

        .sidebar a{
            display: block;
            color: white;
            text-decoration: none;
            padding: 15px 25px;
            transition: .3s;
        }

        .sidebar a:hover{
            background: #d4a056;
            color: white;
        }

        .content{
            margin-right: 260px;
            padding: 30px;
        }

    </style>

</head>

<body>

    <div class="sidebar">

        <h3>{{ $setting->restaurant_name ?? 'بيت أهلنا' }}</h3>

        <a href="{{ route('dashboard') }}">🏠 لوحة التحكم</a>
        <a href="{{ route('meals.index') }}">🍔 الوجبات</a>
        <a href="{{ route('categories.index') }}">🍱 الأقسام</a>
        <a href="{{ route('delivery.index') }}">🚚 موظفو التوصيل</a>
        <a href="{{ route('orders.index') }}">📦 الطلبات</a>
        <a href="{{ route('users.index') }}">👥 المستخدمين</a>
        <a href="{{ route('offers.index') }}">🔥 العروض الخاصة</a>
        <a href="{{ route('settings.edit') }}">⚙️ الإعدادات</a>

    </div>

    <div class="content">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>