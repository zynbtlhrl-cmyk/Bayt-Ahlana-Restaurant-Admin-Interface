
@extends('layouts.app')

@section('content')

<div dir="rtl">

    <style>

        .categories-page {
            padding: 30px;
            background: #f7f7f7;
            min-height: 100vh;
        }

        /* رأس الصفحة */
        .page-header {
            background: linear-gradient(135deg, #ff6b35, #ffb347);
            border-radius: 20px;
            padding: 25px 30px;
            color: white;
            margin-bottom: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 8px 25px rgba(0,0,0,.10);
        }

        .page-header h2 {
            margin: 0;
            font-weight: bold;
        }

        .page-header p {
            margin: 7px 0 0;
            opacity: .9;
        }

        .add-btn {
            background: white;
            color: #e85d2a;
            border: none;
            padding: 12px 22px;
            border-radius: 12px;
            font-weight: bold;
            cursor: pointer;
            transition: .2s;
        }

        .add-btn:hover {
            transform: translateY(-2px);
            background: #fff8f3;
        }

        /* كروت الأقسام */
        .category-card {
            background: white;
            border-radius: 18px;
            overflow: hidden;
            border: none;
            box-shadow: 0 5px 18px rgba(0,0,0,.08);
            transition: .25s;
            height: 100%;
        }

        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 28px rgba(0,0,0,.13);
        }

        .category-image {
            width: 100%;
            height: 190px;
            object-fit: cover;
            display: block;
            background: #eeeeee;
        }

        .no-image {
            width: 100%;
            height: 190px;
            background: #f1f1f1;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #aaa;
        }

        .category-content {
            padding: 18px;
        }

        .category-name {
            font-size: 20px;
            font-weight: bold;
            color: #2c1b10;
            margin-bottom: 15px;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
        }

        .edit-btn,
        .delete-btn {
            flex: 1;
            border-radius: 10px;
            padding: 10px;
            text-align: center;
            text-decoration: none;
            border: none;
            font-weight: bold;
            cursor: pointer;
            transition: .2s;
        }

        .edit-btn {
            background: #fff3e8;
            color: #e85d2a;
        }

        .edit-btn:hover {
            background: #ffe5d3;
            color: #d94f20;
        }

        .delete-btn {
            background: #ffe9e9;
            color: #dc3545;
        }

        .delete-btn:hover {
            background: #ffd8d8;
        }

        /* صندوق لا توجد أقسام */
        .empty-box {
            background: white;
            border-radius: 18px;
            padding: 60px 20px;
            text-align: center;
            color: #777;
            box-shadow: 0 5px 18px rgba(0,0,0,.06);
        }

        .empty-box i {
            font-size: 60px;
            margin-bottom: 15px;
            color: #ffb347;
        }

        .alert {
            border-radius: 12px;
        }

        /* Modal */
        .modal-content {
            border: none;
            border-radius: 20px;
            overflow: hidden;
        }

        .modal-header {
            background: linear-gradient(135deg, #ff6b35, #ffb347);
            color: white;
            border: none;
            padding: 18px 22px;
        }

        .modal-header .btn-close {
            filter: brightness(0) invert(1);
            margin: 0;
        }

        .modal-title {
            font-weight: bold;
        }

        .modal-body {
            padding: 25px;
        }

        .form-label {
            font-weight: bold;
            color: #2c1b10;
            margin-bottom: 8px;
        }

        .form-control {
            border-radius: 12px;
            padding: 12px;
            border: 1px solid #ddd;
        }

        .form-control:focus {
            border-color: #ff8a4c;
            box-shadow: 0 0 0 .2rem rgba(255,107,53,.15);
        }

        .save-btn {
            background: linear-gradient(135deg, #ff6b35, #ffb347);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 12px 25px;
            font-weight: bold;
        }

        .cancel-btn {
            border-radius: 12px;
            padding: 12px 25px;
        }

        /* معاينة الصورة */
        .image-preview {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 14px;
            margin-top: 12px;
            display: none;
        }

        .old-image {
            width: 130px;
            height: 100px;
            object-fit: cover;
            border-radius: 12px;
            margin-top: 10px;
        }

    </style>


    <div class="categories-page">

        {{-- رسالة النجاح --}}
        @if(session('success'))

            <div class="alert alert-success">

                <i class="fa-solid fa-circle-check"></i>

                {{ session('success') }}

            </div>

        @endif


        {{-- الأخطاء --}}
        @if($errors->any())

            <div class="alert alert-danger">

                <ul class="mb-0">

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif


        {{-- ========================= --}}
        {{-- رأس الصفحة --}}
        {{-- ========================= --}}

        <div class="page-header">

            <div>

                <h2>
                    <i class="fa-solid fa-layer-group"></i>
                    إدارة الأقسام
                </h2>

                <p>
                    إضافة وتعديل وحذف أقسام المطعم
                </p>

            </div>


            <button
                type="button"
                class="add-btn"
                data-bs-toggle="modal"
                data-bs-target="#addCategoryModal"
            >

                <i class="fa-solid fa-plus"></i>

                إضافة قسم

            </button>

        </div>


        {{-- ========================= --}}
        {{-- عرض الأقسام --}}
        {{-- ========================= --}}

        @if($categories->count() > 0)

            <div class="row g-4">

                @foreach($categories as $category)

                    <div class="col-12 col-sm-6 col-lg-4 col-xl-3">

                        <div class="category-card">

                            {{-- الصورة --}}
                    @if($category->image)
    <img src="/storage/{{ ltrim($category->image, '/') }}"
         alt="{{ $category->name }}"
         class="category-image"
         onerror="this.style.display='none'; this.parentElement.querySelector('.no-image-fallback').style.display='flex';">

    <div class="no-image no-image-fallback" style="display:none;">
        لا يمكن العثور على الصورة
    </div>
@else
    <div class="no-image">
        لا توجد صورة
    </div>
@endif


                            <div class="category-content">

                                {{-- اسم القسم --}}
                                <div class="category-name">

                                    {{ $category->name }}

                                </div>


                                <div class="action-buttons">

                                    {{-- تعديل --}}
                                    <button
                                        type="button"
                                        class="edit-btn"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editCategory{{ $category->id }}"
                                    >

                                        <i class="fa-solid fa-pen"></i>

                                        تعديل

                                    </button>


                                    {{-- حذف --}}
                                    <form
                                        action="{{ route('categories.destroy', $category->id) }}"
                                        method="POST"
                                        class="delete-form"
                                    >

                                        @csrf

                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="delete-btn w-100"
                                        >

                                            <i class="fa-solid fa-trash"></i>

                                            حذف

                                        </button>

                                    </form>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- ========================= --}}
                    {{-- Modal تعديل القسم --}}
                    {{-- ========================= --}}

                    <div
                        class="modal fade"
                        id="editCategory{{ $category->id }}"
                        tabindex="-1"
                        aria-hidden="true"
                    >

                        <div class="modal-dialog modal-dialog-centered">

                            <div class="modal-content">

                                <div class="modal-header">

                                    <h5 class="modal-title">

                                        <i class="fa-solid fa-pen"></i>

                                        تعديل القسم

                                    </h5>

                                    <button
                                        type="button"
                                        class="btn-close"
                                        data-bs-dismiss="modal"
                                    ></button>

                                </div>


                                <form
                                    action="{{ route('categories.update', $category->id) }}"
                                    method="POST"
                                    enctype="multipart/form-data"
                                >

                                    @csrf

                                    @method('PUT')


                                    <div class="modal-body">

                                        {{-- الاسم --}}
                                        <div class="mb-3">

                                            <label class="form-label">

                                                اسم القسم

                                            </label>

                                            <input
                                                type="text"
                                                name="name"
                                                class="form-control"
                                                value="{{ $category->name }}"
                                                required
                                            >

                                        </div>


                                        {{-- الصورة الحالية --}}
                                        @if($category->image)

                                            <div class="mb-3">

                                                <label class="form-label">

                                                    الصورة الحالية

                                                </label>

                                                <br>

                                                <img
                                                    src="{{ url('/storage/' . ltrim($category->image, '/')) }}"
                                                    class="old-image"
                                                    alt="{{ $category->name }}"
                                                >

                                            </div>

                                        @endif


                                        {{-- صورة جديدة --}}
                                        <div class="mb-3">

                                            <label class="form-label">

                                                تغيير الصورة

                                            </label>

                                            <input
                                                type="file"
                                                name="image"
                                                class="form-control"
                                                accept="image/jpeg,image/png,image/webp"
                                                onchange="previewEditImage(this, {{ $category->id }})"
                                            >

                                            <small class="text-muted">

                                                اتركها فارغة إذا لا تريد تغيير الصورة.

                                            </small>


                                            <img
                                                id="editPreview{{ $category->id }}"
                                                class="image-preview"
                                                alt="معاينة الصورة"
                                            >

                                        </div>


                                        <div class="d-flex gap-2">

                                            <button
                                                type="submit"
                                                class="save-btn"
                                            >

                                                <i class="fa-solid fa-check"></i>

                                                حفظ التعديل

                                            </button>


                                            <button
                                                type="button"
                                                class="btn btn-secondary cancel-btn"
                                                data-bs-dismiss="modal"
                                            >

                                                إلغاء

                                            </button>

                                        </div>

                                    </div>

                                </form>

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

        @else

            {{-- لا توجد أقسام --}}
            <div class="empty-box">

                <i class="fa-solid fa-layer-group"></i>

                <h4>
                    لا توجد أقسام حاليًا
                </h4>

                <p>
                    ابدأ بإضافة أول قسم للمطعم
                </p>


                <button
                    type="button"
                    class="btn btn-warning"
                    data-bs-toggle="modal"
                    data-bs-target="#addCategoryModal"
                    style="border-radius:12px;"
                >

                    <i class="fa-solid fa-plus"></i>

                    إضافة أول قسم

                </button>

            </div>

        @endif

    </div>


    {{-- ========================= --}}
    {{-- Modal إضافة قسم --}}
    {{-- ========================= --}}

    <div
        class="modal fade"
        id="addCategoryModal"
        tabindex="-1"
        aria-hidden="true"
    >

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title">

                        <i class="fa-solid fa-plus-circle"></i>

                        إضافة قسم جديد

                    </h5>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                    ></button>

                </div>


                <form
                    action="{{ route('categories.store') }}"
                    method="POST"
                    enctype="multipart/form-data"
                >

                    @csrf


                    <div class="modal-body">

                        {{-- اسم القسم --}}
                        <div class="mb-3">

                            <label class="form-label">

                                اسم القسم

                            </label>

                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                placeholder="مثال: المقبلات"
                                required
                            >

                        </div>


                        {{-- الصورة --}}
                        <div class="mb-3">

                            <label class="form-label">

                                صورة القسم

                            </label>

                            <input
                                type="file"
                                name="image"
                                class="form-control"
                                accept="image/jpeg,image/png,image/webp"
                                onchange="previewAddImage(this)"
                            >

                            <small class="text-muted">

                                JPG / JPEG / PNG / WEBP — الحد الأقصى 2MB

                            </small>


                            {{-- معاينة الصورة --}}
                            <img
                                id="addImagePreview"
                                class="image-preview"
                                alt="معاينة الصورة"
                            >

                        </div>


                        <div class="d-flex gap-2">

                            <button
                                type="submit"
                                class="save-btn"
                            >

                                <i class="fa-solid fa-check"></i>

                                حفظ القسم

                            </button>


                            <button
                                type="button"
                                class="btn btn-secondary cancel-btn"
                                data-bs-dismiss="modal"
                            >

                                إلغاء

                            </button>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>


{{-- SweetAlert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>

    // =========================================
    // معاينة صورة الإضافة
    // =========================================

    function previewAddImage(input) {

        const preview = document.getElementById('addImagePreview');

        if (input.files && input.files[0]) {

            const reader = new FileReader();

            reader.onload = function(e) {

                preview.src = e.target.result;

                preview.style.display = 'block';

            };

            reader.readAsDataURL(input.files[0]);

        } else {

            preview.style.display = 'none';

        }

    }


    // =========================================
    // معاينة صورة التعديل
    // =========================================

    function previewEditImage(input, id) {

        const preview = document.getElementById('editPreview' + id);

        if (input.files && input.files[0]) {

            const reader = new FileReader();

            reader.onload = function(e) {

                preview.src = e.target.result;

                preview.style.display = 'block';

            };

            reader.readAsDataURL(input.files[0]);

        } else {

            preview.style.display = 'none';

        }

    }


    // =========================================
    // تأكيد الحذف
    // =========================================

    document.querySelectorAll('.delete-form').forEach(function(form) {

        form.addEventListener('submit', function(e) {

            e.preventDefault();

            Swal.fire({

                title: 'هل أنت متأكد؟',

                text: 'سيتم حذف القسم والصورة الخاصة به نهائيًا.',

                icon: 'warning',

                showCancelButton: true,

                confirmButtonText: 'نعم، احذف القسم',

                cancelButtonText: 'إلغاء',

                reverseButtons: true,

                confirmButtonColor: '#dc3545',

                cancelButtonColor: '#6c757d',

                background: '#ffffff',

                borderRadius: '18px'

            }).then((result) => {

                if (result.isConfirmed) {

                    form.submit();

                }

            });

        });

    });


    // =========================================
    // رسالة نجاح جميلة
    // =========================================

    @if(session('success'))

        Swal.fire({

            icon: 'success',

            title: 'تم بنجاح',

            text: '{{ session('success') }}',

            confirmButtonText: 'حسنًا',

            confirmButtonColor: '#ff6b35',

            timer: 2200,

            timerProgressBar: true

        });

    @endif

</script>

@endsection

