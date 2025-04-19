<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Meal;
use App\Models\MealOption;
use App\Models\MealPackage;
use App\Models\Package;
use Illuminate\Http\Request;

class MealPackageController extends Controller
{
    public function index()
    {
        $mealPackages = MealPackage::with(['meal', 'package'])->latest()->get();

        // Statistics
        $stats = [
            'total' => MealPackage::count(),
            'breakfast' => MealPackage::where('type', 'breakfast')->count(),
            'lunch' => MealPackage::where('type', 'lunch')->count(),
            'dinner' => MealPackage::where('type', 'dinner')->count(),
            'snack' => MealPackage::where('type', 'snack')->count(),
            'latest' => MealPackage::with(['meal', 'package'])->latest()->take(5)->get(),
        ];

        $meals = MealOption::all();
        $packages = Package::all();

        return view('admin.meal-packages.index', compact('mealPackages', 'stats', 'meals', 'packages'));
    }
    public function show($id)
    {
        $package = Package::with('meals')->findOrFail($id);
        $allMeals = Meal::all(); // جميع الوجبات المتاحة للإضافة
        $packageStats = [
            'total_meals' => $package->meals->count(),
            'breakfast' => $package->meals->where('pivot.type', 'breakfast')->count(),
            'lunch' => $package->meals->where('pivot.type', 'lunch')->count(),
            'dinner' => $package->meals->where('pivot.type', 'dinner')->count(),
            'snack' => $package->meals->where('pivot.type', 'snack')->count(),
        ];

        return view('admin.meal-packages.package-meals', compact('package', 'allMeals', 'packageStats'));
    }
    public function addMeal(Request $request, $packageId)
    {
        $request->validate([
            'meal_id' => 'required|exists:meals,id',
            'type' => 'required|in:breakfast,lunch,dinner,snack',
            'date' => 'nullable|date',
        ]);

        $package = Package::findOrFail($packageId);

        // تجنب تكرار الوجبة في الباقة
        if (!$package->meals()->where('meal_id', $request->meal_id)->exists()) {
            $package->meals()->attach($request->meal_id, [
                'type' => $request->type,
                'date' => $request->date
            ]);

            return back()->with('success', 'تمت إضافة الوجبة إلى الباقة بنجاح');
        }

        return back()->with('error', 'هذه الوجبة موجودة بالفعل في الباقة');
    }
    public function store(Request $request)
    {
        $request->validate([
            'meal_id' => 'required|exists:meals,id',
            'package_id' => 'required|exists:packages,id',
            'type' => 'required|in:breakfast,lunch,dinner,snack',
            'date' => 'nullable|date',
        ]);

        MealPackage::create($request->all());

        return redirect()->back()
            ->with('success', 'Meal package created successfully.');
    }

    public function update(Request $request, MealPackage $mealPackage)
    {
        $request->validate([
            'meal_id' => 'required|exists:meals,id',
            'package_id' => 'required|exists:packages,id',
            'type' => 'required|in:breakfast,lunch,dinner,snack',
            'date' => 'nullable|date',
        ]);

        $mealPackage->update($request->all());

        return redirect()->back()
            ->with('success', 'Meal package updated successfully.');
    }

    public function destroy(MealPackage $mealPackage)
    {
        $mealPackage->delete();

        return redirect()->back()
            ->with('success', 'Meal package deleted successfully.');
    }
}
