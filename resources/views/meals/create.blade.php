<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>إضافة وجبة</title>

    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body{
            font-family: 'Cairo', Tahoma;
            background: linear-gradient(135deg, #f4f6f9, #e9ecef);
            padding:30px;
        }

        .container{
            max-width:700px;
            margin:auto;
        }

        .top-bar{
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:20px;
        }

        .back-btn{
            background:#6c757d;
            color:#fff;
            padding:10px 15px;
            border-radius:8px;
            text-decoration:none;
            font-size:14px;
            transition:0.3s;
        }

        .back-btn:hover{
            background:#5a6268;
        }

        .card{
            background:#fff;
            padding:30px;
            border-radius:15px;
            box-shadow:0 10px 25px rgba(0,0,0,0.08);
        }

        h1{
            margin-bottom:20px;
            color:#333;
            font-size:22px;
        }

        .form-group{
            margin-bottom:15px;
        }

        input{
            width:100%;
            padding:14px;
            border:1px solid #ddd;
            border-radius:10px;
            outline:none;
            transition:0.3s;
            font-size:15px;
        }

        input:focus{
            border-color:#28a745;
            box-shadow:0 0 5px rgba(40,167,69,0.2);
        }

        .btn{
            width:100%;
            padding:14px;
            background:linear-gradient(45deg,#28a745,#20c997);
            border:none;
            color:#fff;
            font-size:16px;
            border-radius:10px;
            cursor:pointer;
            transition:0.3s;
        }

        .btn:hover{
            transform:scale(1.02);
        }

        .success{
            background:#d4edda;
            color:#155724;
            padding:12px;
            border-radius:10px;
            margin-bottom:15px;
        }

        .title{
            display:flex;
            align-items:center;
            gap:10px;
        }

        .title span{
            font-size:22px;
        }
    </style>
</head>
<body>

<div class="container">

    <!-- Top Bar -->
    <div class="top-bar">
        <a class="back-btn" href="{{ route('meals.index') }}">⬅ رجوع للقائمة</a>
    </div>

    <div class="card">

        <div class="title">
            <span>🍔</span>
            <h1>إضافة وجبة جديدة</h1>
        </div>

        @if(session('success'))
            <div class="success">
                {{ session('success') }}
            </div>
        @endif
<form action="{{ route('meals.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
        <input type="text" name="name" placeholder="اسم الوجبة" required>
    </div>

    <div class="form-group">
        <input type="number" step="0.01" name="price" placeholder="السعر" required>
    </div>

    <!-- 🖼️ صورة -->
    <div class="form-group">
        <input type="file" name="image" accept="image/*">
    </div>

    <!-- 📂 تصنيفات -->
  <div class="form-group">

    <select name="category_id" required
            style="width:100%;padding:14px;border-radius:10px;border:1px solid #ddd;">

        <option value="">اختر التصنيف</option>

        @foreach($categories as $category)

            <option value="{{ $category->id }}">
                {{ $category->name }}
            </option>

        @endforeach

    </select>

</div>
    </div>

    <button class="btn" type="submit">
        💾 حفظ الوجبة
    </button>
</form>

    </div>

</div>

</body>
</html>