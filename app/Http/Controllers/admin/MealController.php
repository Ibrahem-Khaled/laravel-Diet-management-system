<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Meal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MealController extends Controller
{
    public function index()
    {
        $meals = Meal::with(['category', 'options'])->latest()->get();

        $stats = [
            'total' => Meal::count(),
            'active' => Meal::where('is_active', true)->count(),
            'with_options' => Meal::with('options')->count(),
            'new_this_week' => Meal::where('created_at', '>=', now()->subWeek())->count(),
            'avg_price' => Meal::avg('price')
        ];

        return view('admin.meals.index', compact('meals', 'stats'));
    }

    // في ملف app/Http/Controllers/admin/MealController.php
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'options' => 'nullable|array',
            'options.*' => 'exists:options,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'calories' => 'nullable|numeric|min:0',
            'carbohydrates' => 'nullable|numeric|min:0',
            'proteins' => 'nullable|numeric|min:0',
            'fats' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric|min:0',
            'is_active' => 'boolean'
        ]);

        $data = $request->except('options');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('meals', 'public');
        }

        $meal = Meal::create($data);

        if ($request->has('options')) {
            $meal->options()->sync($request->options);
        }

        return redirect()->route('meals.index')
            ->with('success', 'تم إضافة الوجبة بنجاح');
    }

    public function update(Request $request, Meal $meal)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'options' => 'nullable|array',
            'options.*' => 'exists:options,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'calories' => 'nullable|numeric|min:0',
            'carbohydrates' => 'nullable|numeric|min:0',
            'proteins' => 'nullable|numeric|min:0',
            'fats' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric|min:0',
            'is_active' => 'boolean'
        ]);

        $data = $request->except('options');

        if ($request->hasFile('image')) {
            if ($meal->image) {
                Storage::disk('public')->delete($meal->image);
            }
            $data['image'] = $request->file('image')->store('meals', 'public');
        }

        $meal->update($data);

        $meal->options()->sync($request->options ?? []);

        return redirect()->route('meals.index')
            ->with('success', 'تم تحديث الوجبة بنجاح');
    }

    public function destroy(Meal $meal)
    {
        if ($meal->image) {
            Storage::disk('public')->delete($meal->image);
        }

        $meal->delete();

        return redirect()->route('meals.index')
            ->with('success', 'تم حذف الوجبة بنجاح');
    }
}
