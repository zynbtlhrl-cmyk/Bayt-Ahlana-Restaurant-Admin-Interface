<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\Api\OrderApiController;
use App\Http\Controllers\Api\MealApiController;


// =====================================
// تسجيل الدخول وإنشاء الحساب
// =====================================

Route::post('/register', [UserController::class, 'apiRegister']);
Route::post('/login', [UserController::class, 'apiLogin']);


// =====================================
// الأقسام والعروض والوجبات
// =====================================

Route::get('/categories', [CategoryController::class, 'apiIndex']);

Route::get('/offers', [OfferController::class, 'apiIndex']);

Route::get('/meals', [MealApiController::class, 'index']);

Route::get('/meals/{id}', [MealApiController::class, 'show']);

Route::get('/categories/{categoryId}/meals', [
    MealApiController::class,
    'byCategory'
]);


// =====================================
// صور الأقسام والوجبات والعروض
// =====================================



// صور الأقسام
Route::get('/category-image/{filename}', function ($filename) {
    $path = storage_path('app/public/categories/' . basename($filename));

    abort_unless(is_file($path), 404);

    return response(file_get_contents($path), 200, [
        'Content-Type' => mime_content_type($path) ?: 'application/octet-stream',
        'Access-Control-Allow-Origin' => '*',
        'Cross-Origin-Resource-Policy' => 'cross-origin',
    ]);
});

// صور الأكلات
Route::get('/meal-image/{filename}', function ($filename) {
    $path = public_path('uploads/' . basename($filename));

    abort_unless(is_file($path), 404);

    return response(file_get_contents($path), 200, [
        'Content-Type' => mime_content_type($path) ?: 'application/octet-stream',
        'Access-Control-Allow-Origin' => '*',
        'Cross-Origin-Resource-Policy' => 'cross-origin',
    ]);
});

// صور العروض
Route::get('/offer-image/{filename}', function ($filename) {
    $path = storage_path('app/public/offers/' . basename($filename));

    abort_unless(is_file($path), 404);

    return response(file_get_contents($path), 200, [
        'Content-Type' => mime_content_type($path) ?: 'application/octet-stream',
        'Access-Control-Allow-Origin' => '*',
        'Cross-Origin-Resource-Policy' => 'cross-origin',
    ]);
});


// =====================================
// الطلبات - تتطلب تسجيل الدخول
// =====================================

Route::middleware('auth:sanctum')->group(function () {

    // جلب طلبات المستخدم الحالي
    Route::get('/orders', [OrderApiController::class, 'index']);

    // عرض طلب واحد
    Route::get('/orders/{id}', [OrderApiController::class, 'show']);

    // إنشاء طلب جديد
    Route::post('/orders', [OrderController::class, 'apiStore']);

    // إلغاء الطلب
    Route::patch('/orders/{order}/cancel', [
        OrderApiController::class,
        'cancel'
    ]);

});
  

// عرض بيانات النمستخدم في الفالتر في profile
use Illuminate\Http\Request;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return response()->json([
        'success' => true,
        'user' => [
            'id' => $request->user()->id,
            'name' => $request->user()->name,
            'email' => $request->user()->email,
        ],
    ]);
});
