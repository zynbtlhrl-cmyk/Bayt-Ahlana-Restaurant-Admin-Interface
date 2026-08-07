
@extends('layouts.app')

@section('content')

<nav class="navbar bg-white shadow-sm rounded-4 p-3 mb-4 d-flex justify-content-between">

    <div class="position-relative">

        <button class="btn btn-light rounded-circle"
        data-bs-toggle="modal"
        data-bs-target="#notificationsModal">

    🔔

    @if(\App\Models\Notification::where('is_read', false)->count() > 0)

        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">

           {{ \App\Models\Notification::where('is_read', false)->count() }}

        </span>

    @endif

</button>
        <!-- Modal الإشعارات -->
<div class="modal fade" id="notificationsModal" tabindex="-1">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">🔔 الإشعارات</h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body">

                @foreach(\App\Models\Notification::latest()->get() as $notification)

                    @php
                        $order = \App\Models\Order::find($notification->order_id);
                    @endphp

                    @if($order)

                        <div class="border rounded p-3 mb-3">

                            <p>
                                👤 <strong>الاسم:</strong>
                                {{ $order->customer_name }}
                            </p>

                            <p>
                                🕒 <strong>وقت الطلب:</strong>
                                {{ $order->created_at->format('Y/m/d - h:i A') }}
                            </p>

                        </div>

                    @endif

                @endforeach

            </div>

        </div>

    </div>

</div>

    </div>

    <div class="d-flex align-items-center gap-3">

        <div class="text-end">

            <h6 class="m-0">أحمد المدير</h6>

            <small class="text-muted">
                مدير النظام
            </small>

        </div>

        <img src="{{ asset('uploads/settings/'.$setting->logo) }}"
             width="55"
             height="55"
             class="rounded-circle border border-3 border-warning"
             style="object-fit:cover;">

    </div>

</nav>
</nav>
    <style>
        body{
            background:#f5f6fa;
            font-family:Tahoma;
        }

        .sidebar{
            position:fixed;
            right:0;
            top:0;
            width:260px;
            height:100vh;
            background:#0d1b3e;
            color:white;
            padding-top:20px;
        }

        .sidebar h3{
            text-align:center;
            margin-bottom:30px;
        }

        .sidebar a{
            display:block;
            color:white;
            text-decoration:none;
            padding:15px 25px;
            transition:.3s;
        }

        .sidebar a:hover{
            background:#d4a056;
            color:white;
        }

        .content{
            margin-right:280px;
            padding:30px;
        }

        .card-box{
            background:white;
            border-radius:15px;
            padding:20px;
            box-shadow:0 2px 10px rgba(0,0,0,.08);
            transition:.3s;
        }

        .card-box:hover{
            transform:translateY(-5px);
        }

        .title{
            font-size:30px;
            font-weight:bold;
            margin-bottom:20px;
        }

        table{
            background:white;
            border-radius:15px;
            overflow:hidden;
        }
    </style>




    <div class="title">
        لوحة التحكم
    </div>

    <div class="row g-4">

        <div class="col-md-3">
            <div class="card-box">
                <h6>إجمالي المستخدمين</h6>
                <h2>{{ $usersCount }}</h2>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-box">
                <h6>إجمالي الطلبات</h6>
                <h2>{{ $todayOrders }}</h2>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-box">
                <h6>إجمالي المبيعات</h6>
                <h2>12,560,000 </h2>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-box">
                <h6>طلبات اليوم</h6>
                <h2>{{ $todayOrders }}</h2>
            </div>
        </div>

    </div>
    <div class="mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h3 class="fw-bold">
            🔥 العروض الخاصة
        </h3>

        <a href="{{ route('offers.index') }}"
           class="btn btn-outline-primary rounded-3">

            عرض الكل

        </a>

    </div>

    <div class="row">

        @forelse($offers as $offer)

            <div class="col-md-4 mb-4">

                <div class="card shadow border-0 rounded-4 h-100 position-relative overflow-hidden">

    <div style="
            position:absolute;
            top:12px;
            left:-38px;
            background:#dc3545;
            color:white;
            padding:4px 40px;
            font-size:11px;
            font-weight:bold;
            transform:rotate(-45deg);
            z-index:5;
            box-shadow:0 2px 6px rgba(0,0,0,.2);
                    ">
        🔥 عرض خاص
    </div>

    <img src="{{ $offer->image ? asset($offer->image) : 'https://via.placeholder.com/400x250' }}"
         class="card-img-top"
         style="height:220px; object-fit:cover;">


                    <div class="card-body d-flex flex-column">

                        <h5 class="fw-bold mb-3">
                            {{ $offer->title }}
                        </h5>

                        <p class="text-muted flex-grow-1">
                            {{ $offer->description }}
                        </p>

                        <div class="mb-2">

                            <del class="text-danger">
                                {{ $offer->old_price }} $
                            </del>

                        </div>

                        <h4 class="text-success fw-bold">
                            {{ $offer->new_price }} $
                        </h4>

                        <div class="mt-3">

                            @if($offer->active)

                                <span class="badge bg-success">
                                    مفعل
                                </span>

                            @else

                                <span class="badge bg-danger">
                                    غير مفعل
                                </span>

                            @endif

                        </div>

                    </div>

                </div>

            </div>

        @empty

            <div class="col-12">

                <div class="alert alert-info text-center">

                    لا توجد عروض حالياً

                </div>

            </div>

        @endforelse

    </div>

</div>
<h2 class="text-center fw-bold mb-4">
    📦 الطلبات
</h2>

<div class="row mt-5">

    @forelse($orders as $order)

        <div class="col-md-4 mb-4">

            <div class="card shadow border-0 rounded-4 h-100">

                <div class="card-body">

                    <h5 class="card-title mb-3">
                        🧾 الطلب #{{ $order->id }}
                    </h5>

                    <p>
                        👤
                        <strong>العميل:</strong>
                        {{ $order->customer_name }}
                    </p>

                    <p>
                        💰
                        <strong>السعر:</strong>
                        {{ number_format($order->total_price) }} د.ع
                    </p>

                    <p>
                        📦
                        <strong>الحالة:</strong>

                        @if($order->status == 'pending')

                            <span class="badge bg-primary">
                                قيد التحضير
                            </span>

                        @elseif($order->status == 'shipping')

                            <span class="badge bg-warning">
                                بالطريق
                            </span>

                        @elseif($order->status == 'delivered')

                            <span class="badge bg-success">
                                تم الوصول
                            </span>

                        @elseif($order->status == 'cancelled')

                            <span class="badge bg-danger">
                                ملغي
                            </span>

                        @endif

                    </p>

                </div>

            </div>

        </div>

    @empty

        <div class="col-12">

            <div class="alert alert-secondary text-center">

                لا توجد طلبات

            </div>

        </div>

    @endforelse

</div>

@endsection