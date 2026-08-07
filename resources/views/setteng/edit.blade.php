@extends('layouts.app')

@section('content')



<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>إعدادات المطعم</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
        
<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{

    background:#f3f6fb;
    font-family:Tahoma;
    color:#333;

}

.container{

    max-width:1400px;

}

/*==========================
        Header
===========================*/

.page-header{

    background:linear-gradient(135deg,#005b85,#079cff);
    padding:35px;
    border-radius:25px;
    color:white;
    margin-bottom:35px;
    box-shadow:0 15px 35px rgba(255,107,53,.25);

}

.page-header h2{

    font-size:34px;
    font-weight:bold;
    margin:0;

}

.page-header p{

    margin-top:8px;
    opacity:.9;

}

/*==========================
        Card
===========================*/

.card{

    border:none;
    border-radius:22px;
    overflow:hidden;
    background:white;
    box-shadow:0 10px 30px rgba(0,0,0,.08);
    transition:.35s;
    margin-bottom:25px;

}

.card:hover{

    transform:translateY(-5px);
    box-shadow:0 20px 40px rgba(0,0,0,.12);

}

.card-header{

    border:none;
    padding:18px 25px;
    background:linear-gradient(90deg,#a3a3a3,#1a1919);
    color:white;
    font-size:19px;
    font-weight:bold;

}

.card-header i{

    margin-left:8px;

}

.card-body{

    padding:28px;

}

/*==========================
        Inputs
===========================*/

label{

    font-weight:bold;
    margin-bottom:8px;
    color:#444;

}

.form-control,
.form-select{

    height:50px;
    border-radius:14px;
    border:2px solid #ececec;
    transition:.3s;
    box-shadow:none;

}

textarea.form-control{

    height:auto;

}

.form-control:focus,
.form-select:focus{

    border-color:#005383;
    box-shadow:0 0 0 .18rem rgba(255,107,53,.15);

}

/*==========================
        Image Preview
===========================*/

.preview{

    width:130px;
    height:130px;
    object-fit:cover;
    border-radius:20px;
    border:4px solid white;
    margin-top:15px;
    box-shadow:0 10px 25px rgba(0,0,0,.15);

}

/*==========================
        CheckBox
===========================*/

.form-check{

    background:#fafafa;
    padding:14px;
    border-radius:14px;
    margin-bottom:12px;

}

.form-check-input{

    width:20px;
    height:20px;

}

.form-check-label{

    margin-right:10px;
    font-weight:bold;

}

/*==========================
        Button
===========================*/

.btn-save{

    background:linear-gradient(135deg,#006f83,#006f83);
    color:white;
    border:none;
    border-radius:15px;
    width:100%;
    padding:14px;
    font-size:18px;
    font-weight:bold;
    transition:.35s;

}

.btn-save:hover{

    transform:translateY(-2px);
    background:linear-gradient(135deg,#00a329,#02b119);
    color:white;

}

/*==========================
        Alert
===========================*/

.alert{

    border-radius:15px;

}

</style>

</head>

<body>
    ----
<div class="container py-5">

    <!-- Header -->
    <div class="page-header">

        <div class="d-flex justify-content-between align-items-center flex-wrap">

            <div>
                <h2>
                    <i class="fa-solid fa-gear"></i>
                    إعدادات المطعم
                </h2>

                <p class="mb-0">
                    يمكنك إدارة جميع بيانات المطعم من هذه الصفحة.
                </p>
            </div>

            <div class="text-center mt-3 mt-lg-0">

                <i class="fa-solid fa-store fa-3x"></i>

            </div>

        </div>

    </div>

@if(session('success'))

<div class="alert alert-success shadow-sm">
    <i class="fa-solid fa-circle-check"></i>
    {{ session('success') }}
</div>

@endif

<form action="{{ route('settings.update') }}"
      method="POST"
      enctype="multipart/form-data">

@csrf

<div class="row">

<div class="col-lg-6">

<!-- بيانات المطعم -->

<div class="card">

<div class="card-header">
<i class="fa-solid fa-store"></i>
بيانات المطعم
</div>

<div class="card-body">

<div class="mb-4">

<label>
<i class="fa-solid fa-shop me-2"></i>
اسم المطعم
</label>

<input
type="text"
name="restaurant_name"
class="form-control"
placeholder="اكتب اسم المطعم"
value="{{ old('restaurant_name',$setting->restaurant_name) }}">

</div>

<div class="mb-4">

<label>
<i class="fa-solid fa-align-left me-2"></i>
الوصف
</label>

<textarea
name="description"
rows="5"
class="form-control"
placeholder="وصف مختصر عن المطعم">{{ old('description',$setting->description) }}</textarea>

</div>

<div>

<label>
<i class="fa-solid fa-handshake me-2"></i>
رسالة الترحيب
</label>

<textarea
name="welcome_message"
rows="3"
class="form-control"
placeholder="مرحباً بكم...">{{ old('welcome_message',$setting->welcome_message) }}</textarea>

</div>

</div>

</div>

<!-- معلومات التواصل -->

<div class="card">

<div class="card-header">

<i class="fa-solid fa-phone"></i>

معلومات التواصل

</div>

<div class="card-body">

<div class="mb-4">

<label>

<i class="fa-solid fa-phone-volume me-2"></i>

رقم الهاتف

</label>

<input
type="text"
name="phone"
class="form-control"
placeholder="07xxxxxxxxx"
value="{{ old('phone',$setting->phone) }}">

</div>

<div class="mb-4">

<label>

<i class="fa-brands fa-whatsapp me-2"></i>

واتساب

</label>

<input
type="text"
name="whatsapp"
class="form-control"
placeholder="07xxxxxxxxx"
value="{{ old('whatsapp',$setting->whatsapp) }}">

</div>

<div class="mb-4">

<label>

<i class="fa-solid fa-envelope me-2"></i>

البريد الإلكتروني

</label>

<input
type="email"
name="email"
class="form-control"
placeholder="example@email.com"
value="{{ old('email',$setting->email) }}">

</div>

<div>

<label>

<i class="fa-solid fa-location-dot me-2"></i>

العنوان

</label>

<textarea
name="address"
rows="3"
class="form-control"
placeholder="عنوان المطعم">{{ old('address',$setting->address) }}</textarea>

</div>

</div>

</div>

</div>
-------------
<div class="col-lg-6">

    <!-- الصور -->
    <div class="card">

        <div class="card-header">
            <i class="fa-solid fa-image"></i>
            الشعار وصور المطعم
        </div>

        <div class="card-body">

            <div class="text-center mb-4">

                @if($setting->logo)

                <img src="{{ asset('uploads/settings/'.$setting->logo) }}"
                     class="preview rounded-circle">

                @else

                <img src="https://via.placeholder.com/130"
                     class="preview rounded-circle">

                @endif

                <h6 class="mt-3">الصورة الشخصية</h6>

                <input type="file"
                       name="logo"
                       class="form-control mt-3">

            </div>

            <hr>

            <div>

                <label class="fw-bold mb-3">
                    <i class="fa-solid fa-panorama"></i>
                    البنر الرئيسي
                </label>

                <input
                    type="file"
                    name="banner"
                    class="form-control mb-3">

                @if($setting->banner)

                <img
                    src="{{ asset('uploads/settings/'.$setting->banner) }}"
                    class="img-fluid rounded-4 shadow-sm"
                    style="height:220px;width:100%;object-fit:cover;">

                @endif

            </div>

        </div>

    </div>


    <!-- أوقات العمل -->

    <div class="card">

        <div class="card-header">
            <i class="fa-solid fa-clock"></i>
            أوقات العمل
        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-6">

                    <label>
                        <i class="fa-solid fa-sun"></i>
                        وقت الفتح
                    </label>

                    <input
                        type="time"
                        name="opening_time"
                        class="form-control"
                        value="{{ old('opening_time',$setting->opening_time) }}">

                </div>

                <div class="col-md-6">

                    <label>
                        <i class="fa-solid fa-moon"></i>
                        وقت الإغلاق
                    </label>

                    <input
                        type="time"
                        name="closing_time"
                        class="form-control"
                        value="{{ old('closing_time',$setting->closing_time) }}">

                </div>

            </div>

            <div class="mt-4">

                <label>

                    <i class="fa-solid fa-calendar-days"></i>

                    أيام الدوام

                </label>

                <input
                    type="text"
                    name="working_days"
                    class="form-control"
                    value="{{ old('working_days',$setting->working_days) }}">

            </div>

        </div>

    </div>


    <!-- إعدادات الطلب -->

    <div class="card">

        <div class="card-header">

            <i class="fa-solid fa-truck-fast"></i>

            إعدادات الطلب

        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label>رسوم التوصيل</label>

                    <input
                        type="number"
                        step="0.01"
                        name="delivery_fee"
                        class="form-control"
                        value="{{ old('delivery_fee',$setting->delivery_fee) }}">

                </div>

                <div class="col-md-6 mb-3">

                    <label>الحد الأدنى</label>

                    <input
                        type="number"
                        step="0.01"
                        name="minimum_order"
                        class="form-control"
                        value="{{ old('minimum_order',$setting->minimum_order) }}">

                </div>

            </div>

            <div class="form-check">

                <input
                    class="form-check-input"
                    type="checkbox"
                    name="orders_enabled"
                    {{ $setting->orders_enabled ? 'checked' : '' }}>

                <label class="form-check-label">

                    استقبال الطلبات

                </label>

            </div>

            <div class="form-check">

                <input
                    class="form-check-input"
                    type="checkbox"
                    name="cash_payment"
                    {{ $setting->cash_payment ? 'checked' : '' }}>

                <label class="form-check-label">

                    الدفع نقداً

                </label>

            </div>

            <div class="form-check">

                <input
                    class="form-check-input"
                    type="checkbox"
                    name="online_payment"
                    {{ $setting->online_payment ? 'checked' : '' }}>

                <label class="form-check-label">

                    الدفع الإلكتروني

                </label>

            </div>

        </div>

    </div>


    <!-- التواصل -->

    <div class="card">

        <div class="card-header">

            <i class="fa-solid fa-share-nodes"></i>

            مواقع التواصل

        </div>

        <div class="card-body">

            <div class="mb-3">

                <label>
                    <i class="fab fa-facebook text-primary"></i>
                    Facebook
                </label>

                <input
                    type="text"
                    name="facebook"
                    class="form-control"
                    value="{{ old('facebook',$setting->facebook) }}">

            </div>

            <div class="mb-3">

                <label>
                    <i class="fab fa-instagram text-danger"></i>
                    Instagram
                </label>

                <input
                    type="text"
                    name="instagram"
                    class="form-control"
                    value="{{ old('instagram',$setting->instagram) }}">

            </div>

            <div class="mb-3">

                <label>
                    <i class="fab fa-tiktok"></i>
                    TikTok
                </label>

                <input
                    type="text"
                    name="tiktok"
                    class="form-control"
                    value="{{ old('tiktok',$setting->tiktok) }}">

            </div>

            <div class="mb-4">

                <label>

                    <i class="fa-solid fa-palette"></i>

                    لون الموقع

                </label>

                <input
                    type="color"
                    name="theme_color"
                    class="form-control form-control-color"
                    value="{{ old('theme_color',$setting->theme_color) }}">

            </div>

            <button class="btn btn-save">

                <i class="fa-solid fa-floppy-disk"></i>

                حفظ جميع الإعدادات

            </button>
            <a href="#" class="btn btn-danger w-100 mt-3" onclick="logoutConfirm()">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    تسجيل الخروج
                </a>

                    @csrf

        </div>

    </div>

</div>

</div>

</form>

</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function logoutConfirm() {

    Swal.fire({
        title: 'تسجيل الخروج',
        text: 'هل أنت متأكد من تسجيل الخروج؟',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'نعم، تسجيل الخروج',
        cancelButtonText: 'إلغاء'
    }).then((result) => {

        if (result.isConfirmed) {
            document.getElementById('logout-form').submit();
        }

    });

}
</script>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
    @csrf
</form>
</body>

@endsection