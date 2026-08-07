<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تعديل وجبة</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background:#f5f5f5;
            font-family:Tahoma;
        }

        .card-edit{
            width:500px;
            margin:50px auto;
            background:white;
            padding:30px;
            border-radius:20px;
            box-shadow:0 0 15px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>

<div class="card-edit">

    <h2 class="text-center mb-4">تعديل وجبة</h2>

    {{-- الأخطاء --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('meals.update', $meal->id) }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <!-- الاسم -->
        <div class="mb-3">
            <label>اسم الوجبة</label>
            <input type="text"
                   name="name"
                   class="form-control"
                   value="{{ $meal->name }}">
        </div>

        <!-- السعر -->
        <div class="mb-3">
            <label>السعر</label>
            <input type="text"
                   name="price"
                   class="form-control"
                   value="{{ $meal->price }}">
        </div>

        <!-- القسم -->
        <div class="mb-3">
            <label>القسم</label>

            <select name="category_id" class="form-control">

                @foreach ($categories as $category)

                    <option value="{{ $category->id }}"
                        {{ $meal->category_id == $category->id ? 'selected' : '' }}>

                        {{ $category->name }}

                    </option>

                @endforeach

            </select>
        </div>

        <!-- الصورة -->
        <div class="mb-3">
            <label>صورة الوجبة</label>

            <input type="file"
                   name="image"
                   class="form-control">
        </div>

        <!-- الصورة الحالية -->
        @if ($meal->image)
            <img src="{{ asset('uploads/'.$meal->image) }}"
                 width="120"
                 class="mb-3 rounded">
        @endif

        <button type="submit" class="btn btn-primary w-100">
            تحديث الوجبة
        </button>

    </form>

</div>

</body>
</html>