<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MealController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\DeliveryEmployeeController;



Route::delete('/orders/deleteall', [OrderController::class, 'destroyAll'])
    ->name('orders.destroyAll');
// تسجيل الدخول

Route::get('/login', [AdminAuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AdminAuthController::class, 'login'])
    ->name('login.submit');

Route::post('/logout', [AdminAuthController::class, 'logout'])
    ->name('logout');

// الصفحات المحمية

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::resource('meals', MealController::class);

    Route::resource('orders', OrderController::class);

    Route::resource('users', UserController::class);

Route::resource('categories', CategoryController::class)
    ;

    Route::resource('offers', OfferController::class);

    Route::resource('delivery', DeliveryEmployeeController::class);

    Route::get('/settings', [SettingController::class, 'edit'])
        ->name('settings.edit');

    Route::post('/settings', [SettingController::class, 'update'])
        ->name('settings.update');

    Route::put('/orders/{order}/assign-employee',
        [OrderController::class, 'assignEmployee'])
        ->name('orders.assignEmployee');
});
