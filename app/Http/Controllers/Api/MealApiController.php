<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Meal;
use Illuminate\Http\JsonResponse;

class MealApiController extends Controller
{
    /**
     * جلب جميع الوجبات
     */
    public function index(): JsonResponse
    {
        $meals = Meal::latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'تم جلب الوجبات بنجاح',
            'count' => $meals->count(),
            'meals' => $meals
        ], 200);
    }

    /**
     * جلب وجبة واحدة
     */
    public function show($id): JsonResponse
    {
        $meal = Meal::find($id);

        if (!$meal) {
            return response()->json([
                'success' => false,
                'message' => 'الوجبة غير موجودة'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'تم جلب الوجبة بنجاح',
            'meal' => $meal
        ], 200);
    }

    /**
     * جلب وجبات قسم معيّن
     */
    public function byCategory($categoryId): JsonResponse
    {
        $meals = Meal::where('category_id', $categoryId)
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'تم جلب وجبات القسم بنجاح',
            'count' => $meals->count(),
            'meals' => $meals
        ], 200);
    }
}