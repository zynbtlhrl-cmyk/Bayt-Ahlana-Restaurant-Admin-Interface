<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>إضافة موظف توصيل</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background:#f5f5f5;
        }

        .card{
            max-width:700px;
            margin:auto;
            margin-top:40px;
            border-radius:20px;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="card shadow p-4">

        <h2 class="text-center mb-4">
            🚚 إضافة موظف توصيل
        </h2>

        <form action="{{ route('delivery.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">اسم الموظف</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">رقم الهاتف</label>
                <input type="text" name="phone" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">البريد الإلكتروني</label>
                <input type="email" name="email" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">كلمة المرور</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">وسيلة النقل</label>
                <select name="vehicle" class="form-select">
                    <option value="دراجة">دراجة</option>
                    <option value="سيارة">سيارة</option>
                    
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">الحالة</label>
                <select name="status" class="form-select">
                    <option value="نشط">نشط</option>
                    <option value="غير نشط">غير نشط</option>
                </select>
            </div>

            <button class="btn btn-success w-100">
                ➕ إضافة موظف
            </button>

        </form>

    </div>

</div>

</body>
</html>