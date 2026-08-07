<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>

    <meta charset="UTF-8">

    <title>تعديل العرض</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

</head>

<body style="background:#f5f5f5;">

<div class="container py-5">

    <div class="card shadow border-0 rounded-4">

        <div class="card-body p-5">

            <h2 class="mb-4 text-center">
                ✏ تعديل العرض
            </h2>

            <form action="{{ route('offers.update', $offer->id) }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="mb-3">

                    <label class="form-label">
                        عنوان العرض
                    </label>

                    <input type="text"
                           name="title"
                           value="{{ $offer->title }}"
                           class="form-control"
                           required>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        الوصف
                    </label>

                    <textarea name="description"
                              class="form-control"
                              rows="4">{{ $offer->description }}</textarea>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        الصورة الحالية
                    </label>

                    <br>

                    <img src="{{ asset($offer->image) }}"
                         width="180"
                         class="rounded">

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        تغيير الصورة
                    </label>

                    <input type="file"
                           name="image"
                           class="form-control">

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        السعر القديم
                    </label>

                    <input type="number"
                           step="0.01"
                           name="old_price"
                           value="{{ $offer->old_price }}"
                           class="form-control">

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        السعر الجديد
                    </label>

                    <input type="number"
                           step="0.01"
                           name="new_price"
                           value="{{ $offer->new_price }}"
                           class="form-control"
                           required>

                </div>

                <div class="form-check mb-4">

                    <input class="form-check-input"
                           type="checkbox"
                           name="active"
                           {{ $offer->active ? 'checked' : '' }}>

                    <label class="form-check-label">
                        مفعل
                    </label>

                </div>

                <button type="submit"
                        class="btn btn-warning w-100">

                    تحديث العرض

                </button>

            </form>

        </div>

    </div>

</div>

</body>
</html>