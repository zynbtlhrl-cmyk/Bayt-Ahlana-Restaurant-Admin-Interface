<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>

    <meta charset="UTF-8">

    <title>إضافة عرض</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

</head>

<body style="background:#f5f5f5;">

<div class="container py-5">

    <div class="card shadow border-0 rounded-4">

        <div class="card-body p-5">

            <h2 class="mb-4 text-center">
                ➕ إضافة عرض جديد
            </h2>

            <form action="{{ route('offers.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                <div class="mb-3">

                    <label class="form-label">
                        عنوان العرض
                    </label>

                    <input type="text"
                           name="title"
                           class="form-control"
                           required>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        الوصف
                    </label>

                    <textarea name="description"
                              class="form-control"
                              rows="4"></textarea>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        صورة العرض
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
                           class="form-control">

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        السعر الجديد
                    </label>

                    <input type="number"
                           step="0.01"
                           name="new_price"
                           class="form-control"
                           required>

                </div>

                <div class="form-check mb-4">

                    <input class="form-check-input"
                           type="checkbox"
                           name="active"
                           checked>

                    <label class="form-check-label">
                        مفعل
                    </label>

                </div>

           <button type="submit"
        id="submitBtn"
        class="btn btn-primary w-100"
        onclick="this.disabled=true; this.innerHTML='جاري الحفظ...'; this.form.submit();">
    حفظ العرض
</button>

            </form>

        </div>

    </div>

</div>

</body>
</html>