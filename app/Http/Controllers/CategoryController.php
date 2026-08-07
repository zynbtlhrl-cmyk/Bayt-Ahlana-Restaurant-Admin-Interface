<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    // عرض الأقسام
    public function index()
    {
        $categories = Category::all();

        return view('categories.index', compact('categories'));
    }

    // إضافة قسم
    public function store(Request $request)
    {
            $request->validate(
            [
                'name' => 'required',
            ],
            [
                'name.required' => 'قم بإدخال اسم القسم أولًا.',
            ]
        );

        Category::create([
            'name' => $request->name,
        ]);

        return redirect()
            ->back()
            ->with('success', 'تم إضافة القسم');
    }

    // صفحة التعديل
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);

        return view('categories.edit', compact('category'));
    }

    // تحديث القسم
    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name' => 'required',
        ]);

        $category->update([
            'name' => $request->name,
        ]);

        return redirect()
            ->route('categories.index')
            ->with('success', 'تم تحديث القسم');
    }

    // حذف القسم
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);

        $category->delete();

        return redirect()
            ->route('categories.index')
            ->with('success', 'تم حذف القسم');
    }
}