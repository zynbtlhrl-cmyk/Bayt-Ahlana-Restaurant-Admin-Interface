@extends('layouts.app')

@section('content')



<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>الطلبات</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

        body{
            background:#f3f4f8;
            font-family:Tahoma;
        }

        .page-title{
            font-size:34px;
            font-weight:bold;
            color:#2d1b10;
        }

        .order-card{
            border:none;
            border-radius:22px;
            overflow:hidden;
            transition:0.3s;
            background:white;
        }

        .order-card:hover{
            transform:translateY(-6px);
            box-shadow:0 15px 30px rgba(0,0,0,0.08);
        }

        .card-top{
            background:linear-gradient(135deg,#ff9800,#ffb74d);
            padding:18px;
            color:white;
        }

        .customer-name{
            font-size:22px;
            font-weight:bold;
        }

        .info-box{
            background:#f8f9fa;
            padding:12px 15px;
            border-radius:12px;
            margin-bottom:12px;
            font-size:15px;
        }

        .status{
            display:inline-block;
            padding:8px 16px;
            border-radius:20px;
            color:white;
            font-size:14px;
            font-weight:bold;
        }

        .pending{
            background:#ff9800;
        }

        .done{
            background:#28a745;
        }

        .btn-custom{
            border:none;
            border-radius:12px;
            padding:10px;
            font-size:15px;
            font-weight:bold;
            transition:0.3s;
        }

        .btn-custom:hover{
            transform:scale(1.02);
        }

        .empty-box{
            background:white;
            padding:50px;
            border-radius:20px;
            text-align:center;
            color:#777;
        }

    </style>



<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2 class="page-title">
            📦 إدارة الطلبات
        </h2>

        <span class="badge bg-dark fs-6 p-3">
            عدد الطلبات:
            {{ $orders->count() }}
        </span>

    </div>

    @if($orders->count() > 0)

    <div class="row g-4">

        @foreach($orders as $order)

        <div class="col-lg-4 col-md-6">

            <div class="card order-card shadow-sm">

                <!-- رأس الكارت -->
                <div class="card-top">

                    <div class="customer-name">
                        👤 {{ $order->customer_name }}
                    </div>

                </div>

                <!-- المحتوى -->
                <div class="card-body">

                    <div class="info-box">
                        📞
                        <strong>الهاتف:</strong>
                        {{ $order->phone ?? 'غير متوفر' }}
                    </div>
                    <div class="info-box">
    🕓
                        <strong>وقت الطلب:</strong>

                        {{ $order->created_at->format('Y/m/d - h:i A') }}
                    </div>
                    <div class="info-box">
    🍔
                        <strong>الأكلة:</strong>
                        {{ $order->food_name }}
                    </div>

                    <div class="info-box">
                        🔢
                        <strong>الكمية:</strong>
                        {{ $order->quantity }}
                    </div>

                    <div class="info-box">
                        💰
                        <strong>السعر:</strong>
                        {{ $order->total_price }} $
                    </div>

                    

                 <div class="info-box">

    🕒
    <strong>الحالة:</strong>

    @if($order->status == 'pending')

        <span class="status pending">
            قيد التحضير
        </span>

    @elseif($order->status == 'shipping')

        <span class="status pending">
            بالطريق
        </span>

    @elseif($order->status == 'delivered')

        <span class="status done">
            تم الوصول
        </span>

    @elseif($order->status == 'cancelled')

        <span class="status bg-danger">
            ملغي
        </span>

    @endif

</div>
<form action="{{ route('orders.assignEmployee', $order->id) }}" method="POST">

    @csrf
    @method('PUT')

    <div class="mb-3">

        <label class="form-label">
            🚚 اختر موظف التوصيل
        </label>

        <select name="delivery_employee_id" class="form-select">

            @foreach($employees as $employee)

                <option value="{{ $employee->id }}"
                    {{ $order->delivery_employee_id == $employee->id ? 'selected' : '' }}>

                    {{ $employee->name }}

                </option>

            @endforeach

        </select>

    </div>

    <button type="submit" class="btn btn-primary btn-custom w-100 mb-2">

        🚚 تعيين الموظف

    </button>

</form>

<form action="{{ route('orders.update', $order->id) }}"
      method="POST">

    @csrf
    @method('PUT')

    <select name="status"
            class="form-select mb-3">

        <option value="pending"
            {{ $order->status == 'pending' ? 'selected' : '' }}>
            قيد التحضير
        </option>

        <option value="shipping"
            {{ $order->status == 'shipping' ? 'selected' : '' }}>
            بالطريق
        </option>

        <option value="delivered"
            {{ $order->status == 'delivered' ? 'selected' : '' }}>
            تم الوصول
        </option>

        <option value="cancelled"
            {{ $order->status == 'cancelled' ? 'selected' : '' }}>
            ملغي
        </option>

    </select>

    <button class="btn btn-success btn-custom w-100 mb-2">

        💾 حفظ الحالة

    </button>

</form>
                    <!-- زر الحذف -->
                <form action="{{ route('orders.destroy', $order->id) }}"
                    method="POST"
                    class="delete-order-form">

                        @csrf
                        @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-custom w-100">
                        🗑️ حذف الطلب
                    </button>

                    </form>

                </div>

            </div>

        </div>

        @endforeach

    </div>

    @else

    <div class="empty-box shadow-sm">

        <h4>
            🚫 لا توجد طلبات حالياً
        </h4>

    </div>

    @endif

</div>
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

document.querySelectorAll('.delete-order-form').forEach(function(form){

    form.addEventListener('submit', function(e){

        e.preventDefault();

        Swal.fire({
            title: 'هل أنت متأكد؟',
            text: 'سيتم حذف الطلب نهائياً',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'نعم، احذف',
            cancelButtonText: 'إلغاء'
        }).then((result) => {

            if(result.isConfirmed){
                form.submit();
            }

        });

    });

});

</script>

@endsection