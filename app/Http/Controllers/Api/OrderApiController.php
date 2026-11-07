<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Meal;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderApiController extends Controller
{
    // جلب طلبات المستخدم الحالي فقط
    // جلب طلبات المستخدم الحالي فقط
public function index(Request $request): JsonResponse
{
    $orders = Order::where('user_id', $request->user()->id)
        ->latest()
        ->get();

    $orders->transform(function ($order) {

        if ($order->order_type === 'offer') {

            // البحث عن العرض الخاص
            $offer = \App\Models\Offer::where('title', $order->food_name)->first();

            $order->image = $offer?->image;

            $order->image_url = $offer
                ? url('/api/offer-image/' . basename($offer->image))
                : null;

        } else {

            // البحث عن الوجبة العادية
            $meal = Meal::where('name', $order->food_name)->first();

            $order->image = $meal?->image;

            $order->image_url = $meal
                ? url('/api/meal-image/' . basename($meal->image))
                : null;
        }

        return $order;
    });

    return response()->json([
        'success' => true,
        'message' => 'تم جلب الطلبات بنجاح',
        'count' => $orders->count(),
        'orders' => $orders,
    ]);
}


// جلب طلب واحد خاص بالمستخدم
public function show(Request $request, $id): JsonResponse
{
    $order = Order::where('user_id', $request->user()->id)
        ->find($id);

    if (!$order) {
        return response()->json([
            'success' => false,
            'message' => 'الطلب غير موجود',
        ], 404);
    }

    if ($order->order_type === 'offer') {

        $offer = \App\Models\Offer::where('title', $order->food_name)->first();

        $order->image = $offer?->image;

        $order->image_url = $offer
            ? url('/api/offer-image/' . basename($offer->image))
            : null;

    } else {

        $meal = Meal::where('name', $order->food_name)->first();

        $order->image = $meal?->image;

        $order->image_url = $meal
            ? url('/api/meal-image/' . basename($meal->image))
            : null;
    }

    return response()->json([
        'success' => true,
        'message' => 'تم جلب الطلب بنجاح',
        'order' => $order,
    ]);
}
    // إلغاء طلب المستخدم
    public function cancel(Request $request, $id): JsonResponse
    {
        $order = Order::where('user_id', $request->user()->id)
            ->find($id);

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'الطلب غير موجود',
            ], 404);
        }

        if ($order->status !== 'pending') {
            return response()->json([
                'success' => false,
                'message' => 'لا يمكن إلغاء الطلب في حالته الحالية',
                'status' => $order->status,
            ], 422);
        }

        $order->status = 'cancelled';
        $order->save();

        return response()->json([
            'success' => true,
            'message' => 'تم إلغاء الطلب بنجاح',
            'order' => $order,
        ]);
    }
}
