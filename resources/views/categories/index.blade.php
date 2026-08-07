@extends('layouts.app')

@section('content')

<head>
    <meta charset="UTF-8">
    <title>إدارة الأقسام</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@if ($errors->any())
<script>
Swal.fire({
    icon: 'warning',
    title: 'تنبيه',
    text: '{{ $errors->first() }}',
    confirmButtonText: 'حسناً'
});
</script>
@endif
    <style>
   
        body {
            background: #f5f6fa;
            font-family: Tahoma;
        }

        .page-title {
            font-size: 30px;
            font-weight: bold;
            color: #2c1b10;
        }

        /* صندوق الإضافة */
        .add-box {
            background: linear-gradient(135deg, #ff6b35, #ffb347);
            padding: 20px;
            border-radius: 18px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }

        .add-box input {
            border-radius: 12px;
            border: none;
            padding: 12px;
        }

        .add-box button {
            border-radius: 12px;
            border: none;
            background: #2c1b10;
            color: white;
            font-weight: bold;
            transition: 0.3s;
        }

        .add-box button:hover {
            background: black;
            transform: scale(1.03);
        }

        /* الكارد */
        .cat-card {
            border: none;
            border-radius: 18px;
            border-right: 6px solid #ff6b35;
            transition: 0.3s;
        }

        .cat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(0,0,0,0.12);
        }

        .cat-name {
            font-size: 20px;
            font-weight: bold;
            color: #2c1b10;
        }

        .btn-icon {
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
        }

        .modal-content {
            border-radius: 18px;
        }
    </style>


<div class="container py-4">

    <!-- العنوان -->
    <h2 class="page-title mb-4">🍱 إدارة الأقسام</h2>

    <!-- رسالة نجاح -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- إضافة قسم -->
    <form action="{{ route('categories.store') }}"
          method="POST"
          class="add-box mb-4">

        @csrf

        <div class="row g-2 align-items-center">

          <div class="col-md-9">
            <input type="text"
                name="name"
                class="form-control @error('name') is-invalid @enderror"
                placeholder="اكتب اسم القسم..."
                value="{{ old('name') }}">

            @error('name')
                <div class="invalid-feedback d-block">
                    {{ $message }}
                </div>
            @enderror
        </div>

            <div class="col-md-3">
                <button type="submit"
                        id="submitBtn"
                        class="btn btn-primary w-100"
                        onclick="this.disabled=true; this.innerHTML='جاري الحفظ...'; this.form.submit();">
                  ➕ إضافة
                </button>
               
            </div>

        </div>

    </form>

    <!-- عرض الأقسام -->
    <div class="row g-4">

        @foreach($categories as $category)

        <div class="col-md-4">

            <div class="card cat-card shadow-sm h-100">

                <div class="card-body d-flex justify-content-between align-items-center">

                    <!-- الاسم -->
                    <div class="cat-name">
                        {{ $category->name }}
                    </div>

                    <!-- الأزرار -->
                    <div class="d-flex gap-2">

                        <!-- تعديل -->
                        <button class="btn btn-warning btn-sm btn-icon"
                                data-bs-toggle="modal"
                                data-bs-target="#editModal{{ $category->id }}">

                            ✏️

                        </button>

                        <!-- حذف -->
                        <button class="btn btn-danger btn-sm btn-icon"
                                data-bs-toggle="modal"
                                data-bs-target="#deleteModal{{ $category->id }}">

                            🗑️

                        </button>

                    </div>

                </div>

            </div>

        </div>

        <!-- ========================= -->
        <!-- مودال التعديل -->
        <!-- ========================= -->

        <div class="modal fade"
             id="editModal{{ $category->id }}"
             tabindex="-1">

            <div class="modal-dialog modal-dialog-centered">

                <div class="modal-content">

                    <form action="{{ route('categories.update', $category->id) }}"
                          method="POST">

                        @csrf
                        @method('PUT')

                        <div class="modal-header  d-flex align-items-center">

                            <h5 class="modal-title  me-6"  style="margin-left:300px;">

                                ✏️ تعديل القسم

                            </h5>

                            <button type="button"
                                    class="btn-close"
                                    data-bs-dismiss="modal"></button>

                        </div>

                        <div class="modal-body">

                            <label class="form-label ">

                                اسم القسم

                            </label>

                            <input type="text"
                                   name="name"
                                   class="form-control"
                                   value="{{ $category->name }}">

                        </div>

                        <div class="modal-footer">

                            <button type="button"
                                    class="btn btn-secondary"
                                    data-bs-dismiss="modal">

                                إلغاء

                            </button>

                            <button type="submit"
                                    class="btn btn-warning">

                                تحديث

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

        <!-- ========================= -->
        <!-- مودال الحذف -->
        <!-- ========================= -->

        <div class="modal fade"
             id="deleteModal{{ $category->id }}"
             tabindex="-1">

            <div class="modal-dialog modal-dialog-centered">

                <div class="modal-content">

                    <div class="modal-header" >

                        <h5 class="modal-title text-danger"  style="margin-left:300px;">

                            🗑️ تأكيد الحذف

                        </h5>

                        <button type="button"
                                class="btn-close"
                                data-bs-dismiss="modal"></button>

                    </div>

                    <div class="modal-body text-center">

                        هل تريد حذف القسم:

                        <strong>{{ $category->name }}</strong>

                        ؟

                    </div>

                    <div class="modal-footer">

                        <button type="button"
                                class="btn btn-secondary"
                                data-bs-dismiss="modal">

                            إلغاء

                        </button>

                        <form action="{{ route('categories.destroy', $category->id) }}"
                              method="POST">

                            @csrf
                            @method('DELETE')

                            <button class="btn btn-danger">

                                حذف

                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

        @endforeach

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@endsection