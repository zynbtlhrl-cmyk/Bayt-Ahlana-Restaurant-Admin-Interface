<?php

namespace App\Http\Controllers;
use App\Models\Setting;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Offer;
class DashboardController extends Controller
{

public function index()
{
    $usersCount = User::count();

    $orders = Order::latest()->take(10)->get();

    $todayOrders = Order::count();

    $offers = Offer::latest()->take(3)->get();

    $setting = Setting::first();

    return view('dashboard', compact(
        'usersCount',
        'orders',
        'todayOrders',
        'offers',
        'setting'
    ));
}
}