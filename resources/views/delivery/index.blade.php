@extends('layouts.app')

@section('content')
<head>
    <meta charset="UTF-8">
    <title>موظفو التوصيل</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            
    <style>
        body{
            background:#f4f6f9;
            font-family:Tahoma;
        }

        .card{
            border:none;
            border-radius:20px;
        }

        .table th{
            background:#198754;
            color:white;
        }

        .page-title{
            font-size:30px;
            font-weight:bold;
        }

        .btn-add{
            border-radius:30px;
            padding:8px 20px;
        }

        .badge-active{
            background:#198754;
        }

        .badge-stop{
            background:#dc3545;
        }
    </style>
</head>

<body>

<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2 class="page-title">
            🚚 موظفو التوصيل
        </h2>

        <button class="btn btn-success btn-add"
                data-bs-toggle="modal"
                data-bs-target="#addEmployee">
            + إضافة موظف
        </button>

    </div>

    <div class="card shadow">

        <div class="card-body">

            <table class="table table-bordered table-hover text-center align-middle">

                <thead>
                <tr>
                    <th>#</th>
                    <th>الاسم</th>
                    <th>الهاتف</th>
                    <th>البريد</th>
                    <th>وسيلة النقل</th>
                    <th>الحالة</th>
                    <th>العمليات</th>
                </tr>
                </thead>

                <tbody>

                @forelse($employees as $employee)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $employee->name }}</td>

                        <td>{{ $employee->phone }}</td>

                        <td>{{ $employee->email }}</td>

                        <td>{{ $employee->vehicle }}</td>

                        <td>
                            @if($employee->status=="نشط")
                                <span class="badge badge-active">
                                    نشط
                                </span>
                            @else
                                <span class="badge badge-stop">
                                    غير نشط
                                </span>
                            @endif
                        </td>

                        <td>

                            <a href="{{ route('delivery.edit',$employee->id) }}"
                               class="btn btn-warning btn-sm">
                                ✏️
                            </a>

                          <form action="{{ route('delivery.destroy', $employee->id) }}"
                                method="POST"
                                class="d-inline delete-form">

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger btn-sm">
                                    🗑️
                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="7">
                            لا يوجد موظفون
                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>


<!-- Modal -->

<div class="modal fade" id="addEmployee">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <form action="{{ route('delivery.store') }}" method="POST">

                @csrf
<div class="modal-header position-relative">

    <h5 class="w-100 text-center m-0">
        🚚 إضافة موظف توصيل
    </h5>

    <button type="button"
            class="btn-close position-absolute start-0 top-50 translate-middle-y ms-3"
            data-bs-dismiss="modal">
    </button>

</div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label>الاسم</label>
                        <input type="text"
                               name="name"
                               class="form-control"
                               required>
                    </div>

                    <div class="mb-3">
                        <label>الهاتف</label>
                        <input type="text"
                               name="phone"
                               class="form-control"
                               required>
                    </div>

                    <div class="mb-3">
                        <label>البريد الإلكتروني</label>
                        <input type="email"
                               name="email"
                               class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>وسيلة النقل</label>

                        <select name="vehicle"
                                class="form-select">

                            <option>سيارة</option>
                            <option>دراجة</option>
                            <option>سكوتر</option>

                        </select>

                    </div>

                    <div class="mb-3">
                        <label>الحالة</label>

                        <select name="status"
                                class="form-select">

                            <option>نشط</option>
                            <option>غير نشط</option>

                        </select>

                    </div>

                </div>

                <div class="modal-footer">

                    <button class="btn btn-success">
                        حفظ
                    </button>

                    <button type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">
                        إلغاء
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.querySelectorAll('.delete-form').forEach(function(form){

 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.querySelectorAll('.delete-form').forEach(function(form){

    form.addEventListener('submit', function(e){

        e.preventDefault();

        Swal.fire({
            title: 'هل أنت متأكد؟',
            text: 'سيتم حذف موظف التوصيل نهائياً',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'نعم، احذف',
            cancelButtonText: 'إلغاء'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });

    });

});
</script>

@endsection