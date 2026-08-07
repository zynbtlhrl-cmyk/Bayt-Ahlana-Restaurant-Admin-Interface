@extends('layouts.app')

@section('content')


    <meta charset="UTF-8">

    <title>العروض الخاصة</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <style>

        body{
            background:#f5f5f5;
        }

        .offer-card{
            transition:0.3s;
        }

        .offer-card:hover{
            transform:translateY(-5px);
        }

        .offer-image{
    width:100%;
    height:220px;
    object-fit:cover;
    object-position:center;
    border-top-left-radius:16px;
    border-top-right-radius:16px;
}

    </style>


<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-5">

        <h1 class="fw-bold">
            🔥 العروض الخاصة
        </h1>

        <a href="{{ route('offers.create') }}"
           class="btn btn-primary rounded-3 px-4">

            + إضافة عرض

        </a>

    </div>

    <div class="row">

        @forelse($offers as $offer)

        <div class="col-md-4 mb-4">

            <div class="card offer-card shadow border-0 rounded-4 h-100">
<img src="{{ $offer->image ? asset($offer->image) : 'https://via.placeholder.com/250x250' }}"
     class="offer-image rounded-top-4">

                <div class="card-body d-flex flex-column">

                    <h4 class="fw-bold mb-3">
                        {{ $offer->title }}
                    </h4>

                    <p class="text-muted flex-grow-1">
                        {{ $offer->description }}
                    </p>

                    <div class="mb-2">

                        <del class="text-danger fs-5">
                            {{ $offer->old_price }} $
                        </del>

                    </div>

                    <h3 class="text-success fw-bold">
                        {{ $offer->new_price }} $
                    </h3>

                    <div class="mt-3">

                        @if($offer->active)

                            <span class="badge bg-success px-3 py-2">
                                مفعل
                            </span>

                        @else

                            <span class="badge bg-danger px-3 py-2">
                                غير مفعل
                            </span>

                        @endif

                    </div>

                    <div class="d-flex gap-2 mt-4">

                        <a href="{{ route('offers.edit', $offer->id) }}"
                           class="btn btn-warning w-100 rounded-3">

                            تعديل

                        </a>

                        <form action="{{ route('offers.destroy', $offer->id) }}"
                              method="POST"
                              class="w-100 delete-form">

                            @csrf
                            @method('DELETE')

                            <button type="button"
                                    class="btn btn-danger w-100 rounded-3 delete-btn">

                                حذف

                            </button>

                        </form>

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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

    document.querySelectorAll('.delete-btn').forEach(button => {

        button.addEventListener('click', function () {

            let form = this.closest('.delete-form');

            Swal.fire({

                title: 'هل أنت متأكد؟',

                text: 'لن تستطيع استرجاع العرض بعد الحذف!',

                icon: 'warning',

                showCancelButton: true,

                confirmButtonColor: '#dc3545',

                cancelButtonColor: '#6c757d',

                confirmButtonText: 'نعم، احذف',

                cancelButtonText: 'إلغاء',

                background: '#fff',

                borderRadius: '20px',

                backdrop: `
                    rgba(0,0,0,0.5)
                `

            }).then((result) => {

                if (result.isConfirmed) {

                    form.submit();

                }

            });

        });

    });

</script>

@endsection