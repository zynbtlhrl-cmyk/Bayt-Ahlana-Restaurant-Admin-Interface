<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    // عرض الأقسام
    public function index()
    {
        $categories = Category::all();

        return view('categories.index', compact('categories'));
    }

    // API - جلب الأقسام
    public function apiIndex()
    {
        $categories = Category::all();

        return response()->json([
            'success' => true,
            'categories' => $categories
        ]);
    }

    // إضافة قسم
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            ],
            [
                'name.required' => 'قم بإدخال اسم القسم أولًا.',
                'image.image' => 'الملف المرفوع يجب أن يكون صورة.',
                'image.mimes' => 'صيغة الصورة يجب أن تكون JPG أو JPEG أو PNG أو WEBP.',
                'image.max' => 'حجم الصورة يجب ألا يتجاوز 2 ميجابايت.',
            ]
        );

        $imagePath = null;

        // رفع صورة القسم
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('categories', 'public');
        }

        Category::create([
            'name' => $request->name,
            'image' => $imagePath,
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

        $request->validate(
            [
                'name' => 'required',
                'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            ],
            [
                'name.required' => 'قم بإدخال اسم القسم أولًا.',
                'image.image' => 'الملف المرفوع يجب أن يكون صورة.',
                'image.mimes' => 'صيغة الصورة يجب أن تكون JPG أو JPEG أو PNG أو WEBP.',
                'image.max' => 'حجم الصورة يجب ألا يتجاوز 2 ميجابايت.',
            ]
        );

        // تحديث الاسم
        $category->name = $request->name;

        // إذا تم اختيار صورة جديدة
        if ($request->hasFile('image')) {

            // حذف الصورة القديمة
            if ($category->image && Storage::disk('public')->exists($category->image)) {
                Storage::disk('public')->delete($category->image);
            }

            // حفظ الصورة الجديدة
            $imagePath = $request->file('image')->store('categories', 'public');

            $category->image = $imagePath;
        }

        $category->save();

        return redirect()
            ->route('categories.index')
            ->with('success', 'تم تحديث القسم');
    }

    // حذف القسم
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);

        // حذف صورة القسم
        if ($category->image && Storage::disk('public')->exists($category->image)) {
            Storage::disk('public')->delete($category->image);
        }

        // حذف القسم
        $category->delete();

        return redirect()
            ->route('categories.index')
            ->with('success', 'تم حذف القسم');
    }
}