@extends('layouts.app')

@section('content')


    <meta charset="UTF-8">
    <title>قائمة الوجبات</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
           * {
    font-family: 'Cairo', Tahoma, sans-serif;
}

body {
    background: #f5f6fa;
}

        .container{
            max-width:1100px;
            margin:auto;
        }

        /* Header */
        .header{
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:20px;
        }

        .title{
            font-size:24px;
            font-weight:700;
        }

        .btn-add{
            background:linear-gradient(45deg,#28a745,#20c997);
            color:#fff;
            padding:10px 16px;
            border-radius:10px;
            text-decoration:none;
            transition:0.3s;
        }

        .btn-add:hover{
            transform:scale(1.05);
        }

        /* Card */
        .card{
            background:#fff;
            padding:20px;
            border-radius:15px;
            box-shadow:0 10px 25px rgba(0,0,0,0.08);
        }

        /* Table */
        table{
            width:100%;
            border-collapse:collapse;
            border-radius:10px;
            overflow:hidden;
        }

        table thead{
            background:#343a40;
            color:#fff;
        }

        table th, table td{
            padding:14px;
            text-align:center;
            border-bottom:1px solid #eee;
        }

        table tbody tr:hover{
            background:#f8f9fa;
        }

        /* Buttons */
        .actions{
            display:flex;
            justify-content:center;
            gap:12px;
        }

        .btn{
            width:90px;
            text-align:center;
            padding:9px 0;
            border-radius:8px;
            color:#fff;
            text-decoration:none;
            font-size:13px;
            transition:0.2s;
            border:none;
            cursor:pointer;
        }

        .btn:hover{
            transform:scale(1.05);
        }

        .btn-edit{
            background:#007bff;
        }

        .btn-delete{
            background:#dc3545;
        }

        /* Empty */
        .empty{
            text-align:center;
            padding:20px;
            color:#777;
        }

        /* Modal */
        .modal{
            display:none;
            position:fixed;
            top:0;
            left:0;
            width:100%;
            height:100%;
            background:rgba(0,0,0,0.5);
            justify-content:center;
            align-items:center;
        }

        .modal-box{
            background:#fff;
            padding:25px;
            border-radius:12px;
            text-align:center;
            width:320px;
            box-shadow:0 10px 30px rgba(0,0,0,0.2);
        }

        .modal-box h3{
            margin-bottom:10px;
        }

        .modal-actions{
            display:flex;
            justify-content:center;
            gap:10px;
            margin-top:15px;
        }

        .btn-cancel{
            width:90px;
            padding:9px 0;
            border-radius:8px;
            background:#6c757d;
            color:#fff;
            border:none;
            cursor:pointer;
        }
    </style>
</head>
<body>

<div class="container">

    <!-- Header -->
    <div class="header">
        <div class="title">🍔 قائمة الوجبات</div>

        <a href="{{ route('meals.create') }}" class="btn-add">
            + إضافة وجبة
        </a>
    </div>

    <!-- Table -->
    <div class="card">

        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>الصورة</th>
                    <th>اسم الوجبة</th>
                    <th>القسم</th>
                    <th>السعر</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>

            <tbody>

            @forelse($meals as $meal)
                <tr>
                    <td>{{ $meal->id }}</td>
                    <td>
  <img src="{{ asset('uploads/'.$meal->image) }}"
     style="
        width:60px;
        height:60px;
        object-fit:cover;
        border-radius:12px;
     ">
</td>
                    <td>{{ $meal->category->name ?? 'بدون قسم' }}</td>
                    <td>{{ $meal->name }}</td>
                    <td>{{ $meal->price }} د.ع</td>

                    <td>
                        <div class="actions">

                            <a href="{{ route('meals.edit',$meal->id) }}"
                               class="btn btn-edit">
                                ✏️ تعديل
                            </a>

                            <button type="button"
                                    class="btn btn-delete"
                                    onclick="openModal({{ $meal->id }})">
                                🗑 حذف
                            </button>

                        </div>

                        <!-- Modal -->
                        <div id="modal-{{ $meal->id }}" class="modal">
                            <div class="modal-box">
                                <h3>⚠️ تأكيد الحذف</h3>
                                <p>هل أنت متأكد من حذف هذه الوجبة؟</p>

                                <div class="modal-actions">

                                    <form action="{{ route('meals.destroy',$meal->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-delete">نعم حذف</button>
                                    </form>

                                    <button class="btn-cancel"
                                            onclick="closeModal({{ $meal->id }})">
                                        إلغاء
                                    </button>

                                </div>
                            </div>
                        </div>

                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="empty">
                        لا توجد وجبات مضافة حالياً
                    </td>
                </tr>
            @endforelse

            </tbody>
        </table>

    </div>

</div>

<script>
function openModal(id){
    document.getElementById('modal-' + id).style.display = 'flex';
}

function closeModal(id){
    document.getElementById('modal-' + id).style.display = 'none';
}
</script>

@endsection