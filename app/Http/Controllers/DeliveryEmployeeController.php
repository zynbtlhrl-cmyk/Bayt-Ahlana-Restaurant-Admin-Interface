<?php

namespace App\Http\Controllers;

use App\Models\DeliveryEmployee;
use Illuminate\Http\Request;

class DeliveryEmployeeController extends Controller
{
public function index()
{
    $employees = DeliveryEmployee::latest()->get();

    return view('delivery.index', compact('employees'));
}

    public function create()
    {
        return view('delivery.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'nullable|email',
            'vehicle' => 'required',
            'status' => 'required',
        ]);

        DeliveryEmployee::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'vehicle' => $request->vehicle,
            'status' => $request->status,
        ]);

        return redirect()->route('delivery.index')
            ->with('success', 'تم إضافة موظف التوصيل بنجاح');
    }

    public function show(DeliveryEmployee $deliveryEmployee)
    {
        //
    }
        public function edit($id)
        {
    $deliveryEmployee = DeliveryEmployee::findOrFail($id);

    return view('delivery.edit', compact('deliveryEmployee'));
}
   public function update(Request $request, $id)
{
    $deliveryEmployee = DeliveryEmployee::findOrFail($id);

    $request->validate([
        'name' => 'required',
        'phone' => 'required',
        'email' => 'nullable|email',
        'vehicle' => 'required',
        'status' => 'required',
    ]);

    $deliveryEmployee->update([
        'name' => $request->name,
        'phone' => $request->phone,
        'email' => $request->email,
        'vehicle' => $request->vehicle,
        'status' => $request->status,
    ]);

    return redirect()->route('delivery.index')
        ->with('success', 'تم تعديل الموظف');
}
public function destroy($id)
{
    $employee = DeliveryEmployee::findOrFail($id);

    $employee->delete();

    return redirect()->route('delivery.index')
        ->with('success', 'تم حذف الموظف');
}
}