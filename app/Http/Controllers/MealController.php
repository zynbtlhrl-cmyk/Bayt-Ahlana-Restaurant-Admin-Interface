<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meal;
use App\Models\Category;

class MealController extends Controller
{
    public function index()
    {
        $meals = Meal::all();
        return view('meals.index', compact('meals'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('meals.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'category_id' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png'
        ]);

        $imageName = null;

        // رفع الصورة
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads'), $imageName);
        }

        Meal::create([
            'name' => $request->name,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'image' => $imageName,
        ]);

        return redirect()
            ->route('meals.index')
            ->with('success', 'تم إضافة الوجبة بنجاح');
    }

    public function edit(string $id)
    {
        $meal = Meal::findOrFail($id);
        $categories = Category::all();

        return view('meals.edit', compact('meal','categories'));
    }

    public function update(Request $request, string $id)
    {
        $meal = Meal::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'category_id' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png'
        ]);

        $imageName = $meal->image;

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads'), $imageName);
        }

        $meal->update([
            'name' => $request->name,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'image' => $imageName,
        ]);

        return redirect()
            ->route('meals.index')
            ->with('success', 'تم تحديث الوجبة بنجاح');
    }

    public function destroy(string $id)
    {
        $meal = Meal::findOrFail($id);

        // حذف الصورة من السيرفر إذا موجودة
        if ($meal->image && file_exists(public_path('uploads/'.$meal->image))) {
            unlink(public_path('uploads/'.$meal->image));
        }

        $meal->delete();

        return redirect()
            ->route('meals.index')
            ->with('success', 'تم حذف الوجبة بنجاح');
    }
}