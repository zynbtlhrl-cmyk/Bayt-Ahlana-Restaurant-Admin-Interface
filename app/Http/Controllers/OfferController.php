<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function index()
    {
        $offers = Offer::latest()->get();

        return view('offers.index', compact('offers'));
    }

    public function create()
    {
        return view('offers.create');
    }

public function store(Request $request)
{
    $data = $request->validate([
        'title' => 'required',
        'description' => 'nullable',
        'image' => 'nullable|image',
        'old_price' => 'nullable',
        'new_price' => 'required',
        'active' => 'nullable'
    ]);

    if ($request->hasFile('image')) {

        $path = $request->file('image')->store('offers', 'public');

        $data['image'] = 'storage/' . $path;
    }

    $data['active'] = $request->has('active');

    Offer::create($data);

    return redirect()->route('offers.index');
}
    public function edit(Offer $offer)
    {
        return view('offers.edit', compact('offer'));
    }

public function update(Request $request, Offer $offer)
{
    $data = $request->validate([
        'title' => 'required',
        'description' => 'nullable',
        'image' => 'nullable|image',
        'old_price' => 'nullable',
        'new_price' => 'required',
        'active' => 'nullable'
    ]);

    // إذا تم رفع صورة جديدة
    if ($request->hasFile('image')) {

        $path = $request->file('image')->store('offers', 'public');

        // نخزنها بنفس صيغة الصور القديمة
        $data['image'] = 'storage/' . $path;
    }

    $data['active'] = $request->has('active');

    $offer->update($data);

    return redirect()->route('offers.index');
}
    public function destroy(Offer $offer)
    {
        $offer->delete();

        return back();
    }
}