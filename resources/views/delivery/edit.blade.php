<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>تعديل موظف التوصيل</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background:#f4f6f9;
            font-family:Tahoma;
        }

        .card{
            max-width:700px;
            margin:40px auto;
            border:none;
            border-radius:20px;
        }

        .title{
            font-size:28px;
            font-weight:bold;
            color:#198754;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="card shadow">

        <div class="card-body p-4">

            <h2 class="title text-center mb-4">
                ✏️ تعديل موظف التوصيل
            </h2>

            <form action="{{ route('delivery.update', $deliveryEmployee->id) }}" method="POST">
    @csrf
    @method('PUT')

                <div class="mb-3">
                    <label class="form-label">اسم الموظف</label>
                    <input type="text"
                           name="name"
                           class="form-control"
                           value="{{ $deliveryEmployee->name }}"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">رقم الهاتف</label>
                    <input type="text"
                           name="phone"
                           class="form-control"
                           value="{{ $deliveryEmployee->phone }}"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">البريد الإلكتروني</label>
                    <input type="email"
                           name="email"
                           class="form-control"
                           value="{{ $deliveryEmployee->email }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">وسيلة النقل</label>

                    <select name="vehicle" class="form-select">

                        <option value="سيارة" {{ $deliveryEmployee->vehicle == 'سيارة' ? 'selected' : '' }}>
                            سيارة
                        </option>

                        <option value="دراجة" {{ $deliveryEmployee->vehicle == 'دراجة' ? 'selected' : '' }}>
                            دراجة
                        </option>

                        <option value="سكوتر" {{ $deliveryEmployee->vehicle == 'سكوتر' ? 'selected' : '' }}>
                            سكوتر
                        </option>

                    </select>
                </div>

                <div class="mb-4">
                    <label class="form-label">الحالة</label>

                    <select name="status" class="form-select">

                        <option value="نشط" {{ $deliveryEmployee->status == 'نشط' ? 'selected' : '' }}>
                            نشط
                        </option>

                        <option value="غير نشط" {{ $deliveryEmployee->status == 'غير نشط' ? 'selected' : '' }}>
                            غير نشط
                        </option>

                    </select>
                </div>

                <div class="d-flex justify-content-between">

                    <a href="{{ route('delivery.index') }}" class="btn btn-secondary">
                        رجوع
                    </a>

                    <button class="btn btn-success">
                        💾 حفظ التعديلات
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

</body>

</html>