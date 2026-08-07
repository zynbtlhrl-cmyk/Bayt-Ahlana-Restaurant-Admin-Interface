@extends('layouts.app')

@section('content')


<head>
    <meta charset="UTF-8">
    <title>المستخدمين</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .card:hover {
            transform: translateY(-5px);
            transition: .3s;
        }

        .avatar {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            object-fit: cover;
        }
    </style>
</head>


<div class="container mt-4">

    <!-- 🔍 البحث -->
<form method="GET" action="{{ route('users.index') }}" class="d-flex mb-4">

    <input type="text"
           name="search"
           value="{{ request('search') }}"
           class="form-control me-2"
           placeholder="ابحث عن مستخدم...">

    <button class="btn btn-primary px-4" type="submit">
     بحث
    </button>

</form>

    <h3>👥 قائمة المستخدمين</h3>

    <div class="row mt-3">

        @foreach($users as $user)

            <div class="col-md-4 mb-3">

                <div class="card shadow-sm text-center p-3">

                    <!-- صورة عشوائية -->
                    <img src="https://i.pravatar.cc/150?u={{ $user->id }}"
                         class="avatar mx-auto mb-2">

                    <h5>{{ $user->name }}</h5>

                    <p class="text-muted">{{ $user->email }}</p>

                    <!-- أزرار التحكم -->
                   <td>

                <<form method="POST"
                action="{{ route('users.destroy', $user->id) }}"
                class="delete-form">

                @csrf
                @method('DELETE')

                <button type="submit" class="btn btn-danger btn-sm">
                    🗑️ حذف
                </button>

            </form>

                    </td>

                </div>

            </div>

        @endforeach

    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

document.querySelectorAll('.delete-form').forEach(function(form) {

    form.addEventListener('submit', function(e) {

        e.preventDefault();

        Swal.fire({
            title: 'هل أنت متأكد؟',
            text: 'لن تتمكن من استرجاع المستخدم بعد الحذف',
            icon: 'warning',
            showCancelButton: true,
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