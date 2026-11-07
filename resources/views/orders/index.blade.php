
@extends('layouts.app')

@section('content')

@php
    $offerOrders = $orders->where('order_type', 'offer')->values();
    $normalOrders = $orders->where('order_type', '!=', 'offer')->values();

    $groups = [
        [
            'type' => 'offer',
            'title' => 'طلبات العروض الخاصة',
            'description' => 'الطلبات القادمة من العروض والتخفيضات',
            'orders' => $offerOrders,
        ],
        [
            'type' => 'normal',
            'title' => 'الطلبات العادية',
            'description' => 'الطلبات القادمة من قائمة الأكلات',
            'orders' => $normalOrders,
        ],
    ];
@endphp

<style>
    .orders-page {
        direction: rtl;
        font-family: Tahoma, sans-serif;
        color: #243047;
        padding: 24px;
        border-radius: 24px;
        background: #f4f6fb;
        min-height: 75vh;
    }

    .orders-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 18px;
        margin-bottom: 28px;
    }

    .page-title {
        color: #18243a;
        font-size: 28px;
        font-weight: 900;
        margin: 0;
    }

    .page-subtitle {
        color: #7b8496;
        font-size: 13px;
        margin-top: 8px;
    }

    .header-actions {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    .total-badge {
        display: flex;
        align-items: center;
        gap: 9px;
        padding: 13px 17px;
        border-radius: 14px;
        color: white;
        background: linear-gradient(135deg, #17243d, #35496c);
        box-shadow: 0 6px 16px #18243a1c;
        font-weight: bold;
    }

    .options-button {
        width: 48px;
        height: 48px;
        border: 0;
        border-radius: 14px;
        color: white;
        background: #243047;
        font-size: 29px;
        line-height: 1;
        transition: .2s;
    }

    .options-button:hover {
        background: #3b4d6b;
        transform: translateY(-2px);
    }

    .dropdown-menu {
        border: 1px solid #e8ebf2;
        border-radius: 15px;
        padding: 8px;
        min-width: 225px;
        direction: rtl;
    }

    .dropdown-item {
        border-radius: 10px;
        padding: 12px;
        font-weight: bold;
        white-space: normal;
    }

    .dropdown-item:hover {
        background: #fff0f0;
    }

    .delete-all-item {
        color: #dc3545;
    }

    .order-section {
        margin-bottom: 35px;
    }

    .section-heading {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
        padding: 20px;
        margin-bottom: 22px;
        border-radius: 18px;
    }

    .offer-heading {
        color: #87234f;
        background: linear-gradient(135deg, #fff0f5, #ffe1eb);
        border-right: 5px solid #d63384;
    }

    .normal-heading {
        color: #273e60;
        background: linear-gradient(135deg, #eaf1fc, #dfe9f8);
        border-right: 5px solid #456ba5;
    }

    .section-heading h3 {
        font-size: 21px;
        font-weight: 900;
        margin: 0;
    }

    .section-description {
        margin-top: 7px;
        font-size: 12px;
        opacity: .8;
    }

    .section-count {
        border-radius: 11px;
        padding: 9px 13px;
        font-size: 13px;
        font-weight: bold;
    }

    .order-card {
        height: 100%;
        overflow: hidden;
        background: white;
        border: 1px solid #e9edf4;
        border-radius: 20px;
        transition: transform .22s, box-shadow .22s;
    }

    .order-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 14px 30px #17243d16 !important;
    }

    .offer-card {
        border: 1px solid #f5c5d9;
        background: #fffdfd;
    }

    .card-top {
        color: white;
        padding: 19px;
    }

    .normal-card .card-top {
        background: linear-gradient(135deg, #263f65, #4978b5);
    }

    .offer-card .card-top {
        background: linear-gradient(135deg, #941b50, #df4c87);
    }

    .cancelled-order {
        border: 2px solid #f0a6aa;
    }

    .cancelled-order .card-top {
        background: linear-gradient(135deg, #98212b, #e0525c);
    }

    .customer-name {
        font-size: 19px;
        font-weight: 900;
        overflow-wrap: anywhere;
    }

    .type-label {
        display: inline-block;
        margin-top: 10px;
        padding: 6px 11px;
        border-radius: 20px;
        background: #ffffff2b;
        border: 1px solid #ffffff45;
        font-size: 12px;
        font-weight: bold;
    }

    .order-number {
        font-size: 12px;
        margin-top: 10px;
        opacity: .9;
    }

    .card-body {
        padding: 17px;
    }

    .info-box {
        padding: 12px;
        margin-bottom: 10px;
        border-radius: 12px;
        background: #f5f7fb;
        font-size: 13px;
        overflow-wrap: anywhere;
    }

    .offer-card .info-box {
        background: #fff2f7;
    }

    .info-box strong {
        color: #253550;
    }

    .status {
        display: inline-block;
        padding: 6px 10px;
        border-radius: 20px;
        color: white;
        font-size: 12px;
        font-weight: bold;
    }

    .pending {
        background: #f0a11a;
    }

    .shipping {
        background: #2878d0;
    }

    .done {
        background: #218b56;
    }

    .cancelled {
        background: #dc3545;
    }

    .btn-custom {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 7px;
        width: 100%;
        padding: 11px 12px;
        border: 0;
        border-radius: 12px;
        font-family: Tahoma, sans-serif;
        font-size: 13px;
        font-weight: bold;
        transition: .2s;
    }

    .btn-custom:hover {
        transform: translateY(-1px);
        filter: brightness(.96);
    }

    .btn-delete-order {
        color: white;
        background: linear-gradient(135deg, #d92d3a, #f15b65);
        box-shadow: 0 5px 12px #dc354526;
    }

    .btn-save-status {
        color: white;
        background: linear-gradient(135deg, #198754, #2eb875);
    }

    .btn-assign {
        color: white;
        background: linear-gradient(135deg, #2864b3, #438ce2);
    }

    .cancelled-alert {
        padding: 12px;
        margin-bottom: 13px;
        color: #a51e2b;
        background: #fff0f0;
        border: 1px solid #ffd3d6;
        border-radius: 12px;
        text-align: center;
        font-size: 13px;
        font-weight: bold;
    }

    .empty-section,
    .empty-box {
        padding: 30px 18px;
        border: 1px dashed #cbd3df;
        border-radius: 17px;
        background: white;
        color: #7a8495;
        text-align: center;
    }

    .empty-box {
        padding: 55px 20px;
    }

    .empty-box .empty-icon {
        font-size: 42px;
        margin-bottom: 12px;
    }

    .section-divider {
        display: flex;
        align-items: center;
        gap: 14px;
        margin: 35px 0;
        color: #8b94a4;
        font-size: 12px;
        font-weight: bold;
    }

    .section-divider::before,
    .section-divider::after {
        content: "";
        flex: 1;
        height: 1px;
        background: #d9deea;
    }

    .order-item.order-hidden {
        display: none !important;
    }

    .show-more-btn {
        display: block;
        min-width: 190px;
        margin: 23px auto 10px;
        padding: 12px 20px;
        border: 0;
        border-radius: 13px;
        background: linear-gradient(135deg, #263f65, #4978b5);
        color: white;
        font-weight: bold;
        font-family: Tahoma, sans-serif;
        transition: .2s;
    }

    .show-more-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 7px 15px #17243d1f;
    }

    .offer-more-btn {
        background: linear-gradient(135deg, #941b50, #df4c87);
    }

    .page-alert {
        border: 0;
        border-radius: 13px;
        font-family: Tahoma, sans-serif;
        font-weight: bold;
    }

    @media (max-width: 576px) {
        .orders-page {
            padding: 13px;
        }

        .page-title {
            font-size: 22px;
        }

        .section-heading {
            padding: 15px;
        }

        .section-heading h3 {
            font-size: 18px;
        }

        .total-badge {
            padding: 11px;
            font-size: 12px;
        }
    }
</style>

<div class="orders-page">

    {{-- رسائل النجاح والفشل --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show page-alert" role="alert">
            ✅ {{ session('success') }}
            <button type="button" class="btn-close ms-2"
                    data-bs-dismiss="alert" aria-label="إغلاق"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show page-alert" role="alert">
            ⚠️ {{ session('error') }}
            <button type="button" class="btn-close ms-2"
                    data-bs-dismiss="alert" aria-label="إغلاق"></button>
        </div>
    @endif

    {{-- رأس الصفحة --}}
    <div class="orders-header">

        <div>
            <h2 class="page-title">📦 إدارة الطلبات</h2>
            <div class="page-subtitle">
                تابع طلبات الزبائن والعروض الخاصة وتحكم بحالات التوصيل.
            </div>
        </div>

        <div class="header-actions">

            <div class="total-badge">
                <span>📋</span>
                <span>إجمالي الطلبات: {{ $orders->count() }}</span>
            </div>

            <div class="dropdown">
                <button
                    class="options-button"
                    type="button"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                    title="خيارات الطلبات">
                    ⋮
                </button>

                <ul class="dropdown-menu dropdown-menu-end shadow">
                    <li>
                        <button
                            type="button"
                            class="dropdown-item delete-all-item"
                            onclick="confirmDeleteAllOrders()">
                            🗑️ حذف جميع الطلبات
                        </button>
                    </li>
                </ul>
            </div>

        </div>
    </div>

    {{-- نموذج حذف جميع الطلبات --}}
    <form
        id="deleteAllOrdersForm"
        action="{{ route('orders.destroyAll') }}"
        method="POST"
        class="d-none">

        @csrf
        @method('DELETE')
    </form>

    @if($orders->count() > 0)

        @foreach($groups as $group)

            @if(!$loop->first)
                <div class="section-divider">
                    🍔 نهاية طلبات العروض وبداية الطلبات العادية
                </div>
            @endif

            <section class="order-section">

                {{-- عنوان القسم --}}
                <div class="section-heading
                    {{ $group['type'] === 'offer' ? 'offer-heading' : 'normal-heading' }}">

                    <div>
                        <h3>
                            {{ $group['type'] === 'offer' ? '🎁' : '🍔' }}
                            {{ $group['title'] }}
                        </h3>

                        <div class="section-description">
                            {{ $group['description'] }}
                        </div>
                    </div>

                    <span class="section-count
                        {{ $group['type'] === 'offer' ? 'bg-danger text-white' : 'bg-primary text-white' }}">
                        عدد الطلبات: {{ $group['orders']->count() }}
                    </span>

                </div>

                @if($group['orders']->count() > 0)

                    <div class="row g-4">

                        @foreach($group['orders'] as $order)

                            <div class="col-12 col-md-6 col-xl-4 order-item">

                                <div class="order-card shadow-sm
                                    {{ $group['type'] === 'offer' ? 'offer-card' : 'normal-card' }}
                                    {{ $order->status === 'cancelled' ? 'cancelled-order' : '' }}">

                                    {{-- رأس بطاقة الطلب --}}
                                    <div class="card-top">

                                        <div class="customer-name">
                                            👤 {{ $order->customer_name }}
                                        </div>

                                        <span class="type-label">
                                            {{ $group['type'] === 'offer'
                                                ? '🎁 طلب عرض خاص'
                                                : '🍔 طلب عادي' }}
                                        </span>

                                        <div class="order-number">
                                            رقم الطلب: #{{ $order->id }}
                                        </div>

                                    </div>

                                    <div class="card-body">

                                        @if($order->status === 'cancelled')
                                            <div class="cancelled-alert">
                                                🚫 هذا الطلب ملغي
                                            </div>
                                        @endif

                                        <div class="info-box">
                                            📞 <strong>الهاتف:</strong>
                                            {{ $order->phone ?: 'غير متوفر' }}
                                        </div>

                                        <div class="info-box">
                                            🕓 <strong>وقت الطلب:</strong>
                                            {{ $order->created_at
                                                ? $order->created_at->format('Y/m/d - h:i A')
                                                : 'غير متوفر' }}
                                        </div>

                                        <div class="info-box">
                                            {{ $group['type'] === 'offer' ? '🎁' : '🍽️' }}
                                            <strong>
                                                {{ $group['type'] === 'offer' ? 'العرض الخاص:' : 'الأكلة:' }}
                                            </strong>
                                            {{ $order->food_name }}
                                        </div>

                                        <div class="info-box">
                                            🔢 <strong>الكمية:</strong>
                                            {{ $order->quantity }}
                                        </div>

                                        <div class="info-box">
                                            💰 <strong>السعر الإجمالي:</strong>
                                            {{ number_format((float) $order->total_price, 2) }}
                                        </div>

                                        {{-- حالة الطلب --}}
                                        <div class="info-box">
                                            🕒 <strong>الحالة:</strong>

                                            @if($order->status === 'pending')
                                                <span class="status pending">قيد التحضير</span>
                                            @elseif($order->status === 'shipping')
                                                <span class="status shipping">بالطريق</span>
                                            @elseif($order->status === 'delivered')
                                                <span class="status done">تم الوصول</span>
                                            @elseif($order->status === 'cancelled')
                                                <span class="status cancelled">ملغي</span>
                                            @else
                                                <span class="status bg-secondary">
                                                    {{ $order->status }}
                                                </span>
                                            @endif
                                        </div>

                                        {{-- تعيين موظف التوصيل --}}
                                        @if($order->status !== 'cancelled')

                                            <form
                                                action="{{ route('orders.assignEmployee', $order->id) }}"
                                                method="POST"
                                                class="mb-3">

                                                @csrf
                                                @method('PUT')

                                                <label class="form-label fw-bold small">
                                                    🚚 موظف التوصيل
                                                </label>

                                                <select
                                                    name="delivery_employee_id"
                                                    class="form-select mb-2">

                                                    <option value="">اختر الموظف</option>

                                                    @foreach($employees as $employee)
                                                        <option
                                                            value="{{ $employee->id }}"
                                                            {{ $order->delivery_employee_id == $employee->id ? 'selected' : '' }}>
                                                            {{ $employee->name }}
                                                        </option>
                                                    @endforeach

                                                </select>

                                                <button type="submit" class="btn-custom btn-assign">
                                                    🚚 تعيين موظف التوصيل
                                                </button>

                                            </form>

                                        @endif

                                        {{-- تحديث حالة الطلب --}}
                                        <form
                                            action="{{ route('orders.update', $order->id) }}"
                                            method="POST"
                                            class="mb-3">

                                            @csrf
                                            @method('PUT')

                                            <label class="form-label fw-bold small">
                                                تحديث حالة الطلب
                                            </label>

                                            <select name="status" class="form-select mb-2">

                                                <option value="pending"
                                                    {{ $order->status === 'pending' ? 'selected' : '' }}>
                                                    قيد التحضير
                                                </option>

                                                <option value="shipping"
                                                    {{ $order->status === 'shipping' ? 'selected' : '' }}>
                                                    بالطريق
                                                </option>

                                                <option value="delivered"
                                                    {{ $order->status === 'delivered' ? 'selected' : '' }}>
                                                    تم الوصول
                                                </option>

                                                <option value="cancelled"
                                                    {{ $order->status === 'cancelled' ? 'selected' : '' }}>
                                                    ملغي
                                                </option>

                                            </select>

                                            <button type="submit" class="btn-custom btn-save-status">
                                                💾 حفظ حالة الطلب
                                            </button>

                                        </form>

                                        {{-- حذف طلب واحد --}}
                                        <form
                                            action="{{ route('orders.destroy', $order->id) }}"
                                            method="POST"
                                            class="delete-order-form">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn-custom btn-delete-order">
                                                <span>🗑️</span>
                                                <span>حذف هذا الطلب</span>
                                            </button>

                                        </form>

                                    </div>
                                </div>
                            </div>

                        @endforeach

                    </div>

                    {{-- عرض المزيد لكل قسم --}}
                    @if($group['orders']->count() > 3)

                        <button
                            type="button"
                            class="show-more-btn {{ $group['type'] === 'offer' ? 'offer-more-btn' : '' }}"
                            data-expanded="false"
                            onclick="toggleOrders(this)">

                            عرض المزيد ({{ $group['orders']->count() - 3 }})

                        </button>

                    @endif

                @else

                    <div class="empty-section">
                        {{ $group['type'] === 'offer'
                            ? '🎁 لا توجد طلبات عروض خاصة حالياً.'
                            : '🍔 لا توجد طلبات عادية حالياً.' }}
                    </div>

                @endif

            </section>

        @endforeach

    @else

        <div class="empty-box shadow-sm">
            <div class="empty-icon">📭</div>
            <h4 class="fw-bold">لا توجد طلبات حالياً</h4>
            <p class="mb-0">ستظهر هنا طلبات الزبائن الجديدة عند وصولها.</p>
        </div>

    @endif

</div>

{{-- مكتبة نوافذ التأكيد --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // عرض المزيد أو إخفاء الطلبات الزائدة
    function toggleOrders(button) {
        const section = button.closest('.order-section');
        const orders = section.querySelectorAll('.order-item');
        const expanded = button.dataset.expanded === 'true';

        orders.forEach(function(item, index) {
            if (index >= 3) {
                item.classList.toggle('order-hidden', expanded);
            }
        });

        button.dataset.expanded = expanded ? 'false' : 'true';

        button.textContent = expanded
            ? 'عرض المزيد (' + (orders.length - 3) + ')'
            : 'عرض أقل ▲';
    }

    // إخفاء الطلبات بعد أول ثلاثة عند تحميل الصفحة
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.order-section').forEach(function(section) {
            const orders = section.querySelectorAll('.order-item');

            orders.forEach(function(item, index) {
                if (index >= 3) {
                    item.classList.add('order-hidden');
                }
            });
        });
    });

    // تأكيد حذف طلب واحد
    document.querySelectorAll('.delete-order-form').forEach(function(form) {
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            Swal.fire({
                title: 'هل تريد حذف الطلب؟',
                html: '<div style="font-size:14px;color:#687386">سيتم حذف هذا الطلب نهائياً من النظام.</div>',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: '🗑️ نعم، احذف الطلب',
                cancelButtonText: 'رجوع',
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#64748b',
                reverseButtons: true,
                focusCancel: true,
                buttonsStyling: true
            }).then(function(result) {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });

    // تأكيد حذف جميع الطلبات
    function confirmDeleteAllOrders() {
        const form = document.getElementById('deleteAllOrdersForm');

        if (!form) {
            Swal.fire({
                title: 'خطأ',
                text: 'لم يتم العثور على نموذج حذف الطلبات.',
                icon: 'error',
                confirmButtonText: 'حسناً',
                confirmButtonColor: '#243047'
            });
            return;
        }

        Swal.fire({
            title: 'حذف جميع الطلبات؟',
            html: `
                <div style="font-size:14px;line-height:2;color:#687386">
                    هل أنت متأكد من حذف <strong style="color:#dc3545">جميع الطلبات</strong>؟<br>
                    سيتم حذف الطلبات العادية والعروض الخاصة نهائياً.
                    <br>
                    <span style="color:#dc3545;font-weight:bold">
                        ⚠️ لا يمكن التراجع عن هذا الإجراء!
                    </span>
                </div>
            `,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: '🗑️ نعم، احذف الجميع',
            cancelButtonText: 'إلغاء العملية',
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#64748b',
            reverseButtons: true,
            focusCancel: true,
            buttonsStyling: true,
            allowOutsideClick: false
        }).then(function(result) {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }
</script>

@endsection
