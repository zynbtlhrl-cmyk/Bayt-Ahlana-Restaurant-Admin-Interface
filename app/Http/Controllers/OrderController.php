<?php

namespace App\Http\Controllers;
 use App\Models\DeliveryEmployee;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Notification;

class OrderController extends Controller
{


public function index()
{
    $orders = Order::latest()->get();

    $employees = DeliveryEmployee::latest()->get();

    return view('orders.index', compact('orders', 'employees'));
}
public function store(Request $request)
{
    $order = Order::create([
        'customer_name' => $request->customer_name,
        'phone' => $request->phone,
        'food_name' => $request->food_name,
        'quantity' => $request->quantity,
        'total_price' => $request->total_price,
        'status' => 'pending',
    ]);

    Notification::create([
        'title' => 'طلب جديد باسم ' . $order->customer_name,
        'order_id' => $order->id,
        'is_read' => false,
    ]);

    return redirect()->back();
}
    public function update(Request $request, string $id)
    {
        $order = Order::findOrFail($id);

        $order->update([
            'status' => $request->status
        ]);

        return redirect()->back();
    }

    public function destroy(string $id)
    {
        $order = Order::findOrFail($id);

        $order->delete();

        return redirect()->back();
    }
    public function assignEmployee(Request $request, Order $order)
{
    $request->validate([
        'delivery_employee_id' => 'nullable|exists:delivery_employees,id',
    ]);

    $order->update([
        'delivery_employee_id' => $request->delivery_employee_id,
    ]);

    return back()->with('success', 'تم تعيين موظف التوصيل');
}

public function apiStore(Request $request)
{
    $request->validate([
        'customer_name' => 'required|string',
        'phone' => 'required|string',
        'address' => 'required|string',
        'notes' => 'nullable|string',
        'food_name' => 'required|string',
        'quantity' => 'required|integer|min:1',
        'total_price' => 'required|numeric|min:0',
        'order_type' => 'nullable|in:normal,offer',
    ]);

    $order = Order::create([
        'user_id' => $request->user()->id,
        'customer_name' => $request->customer_name,
        'phone' => $request->phone,
        'address' => $request->address,
        'notes' => $request->notes,
        'food_name' => $request->food_name,
        'quantity' => $request->quantity,
        'total_price' => $request->total_price,
        'order_type' => $request->input('order_type', 'normal'),
        'status' => 'pending',
    ]);

    Notification::create([
        'title' => 'طلب جديد باسم ' . $order->customer_name,
        'order_id' => $order->id,
        'is_read' => false,
    ]);

    return response()->json([
        'success' => true,
        'message' => 'تم إرسال الطلب بنجاح',
        'order' => $order,
    ], 201);
}
public function destroyAll()
{
    try {
        $count = Order::count();

        Order::query()->delete();

        return redirect()
            ->route('orders.index')
            ->with('success', "تم حذف جميع الطلبات بنجاح. عدد الطلبات المحذوفة: {$count}");

    } catch (\Throwable $e) {
        report($e);

        return redirect()
            ->route('orders.index')
            ->with('error', 'تعذر حذف الطلبات. تحقق من سجل الأخطاء وعلاقات قاعدة البيانات.');
    }
}
}