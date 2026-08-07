<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    public function edit()
    {
        $setting = Setting::first();

        if (!$setting) {
            $setting = Setting::create([]);
        }

        return view('setteng.edit', compact('setting'));
    }

    public function update(Request $request)
    {
        $setting = Setting::first();

        $data = $request->validate([
            'restaurant_name' => 'required|string|max:255',
            'logo' => 'nullable|image',
            'banner' => 'nullable|image',
            'description' => 'nullable|string',
            'phone' => 'nullable|string',
            'whatsapp' => 'nullable|string',
            'email' => 'nullable|email',
            'address' => 'nullable|string',
            'opening_time' => 'nullable',
            'closing_time' => 'nullable',
            'working_days' => 'nullable|string',
            'delivery_fee' => 'nullable|numeric',
            'minimum_order' => 'nullable|numeric',
            'orders_enabled' => 'nullable',
            'cash_payment' => 'nullable',
            'online_payment' => 'nullable',
            'facebook' => 'nullable|string',
            'instagram' => 'nullable|string',
            'tiktok' => 'nullable|string',
            'theme_color' => 'nullable|string',
            'welcome_message' => 'nullable|string',
        ]);

        if ($request->hasFile('logo')) {
            $logo = time() . '_logo.' . $request->logo->extension();
            $request->logo->move(public_path('uploads/settings'), $logo);
            $data['logo'] = $logo;
        }

        if ($request->hasFile('banner')) {
            $banner = time() . '_banner.' . $request->banner->extension();
            $request->banner->move(public_path('uploads/settings'), $banner);
            $data['banner'] = $banner;
        }

        $data['orders_enabled'] = $request->has('orders_enabled');
        $data['cash_payment'] = $request->has('cash_payment');
        $data['online_payment'] = $request->has('online_payment');

        $setting->update($data);

        return redirect()->back()->with('success', 'تم حفظ الإعدادات بنجاح');
    }
}