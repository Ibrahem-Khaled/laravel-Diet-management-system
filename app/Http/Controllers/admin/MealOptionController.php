<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Option as MealOption;
use Illuminate\Http\Request;

class MealOptionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'option_name' => 'required|string|max:255',
            'option_values' => 'nullable|string'
        ]);

        MealOption::create($request->all());

        return redirect()->back()
            ->with('success', 'تم إضافة الخيار بنجاح');
    }

    public function update(Request $request, MealOption $mealOption)
    {
        $request->validate([
            'option_name' => 'required|string|max:255',
            'option_values' => 'nullable|string'
        ]);

        $mealOption->update($request->all());

        return redirect()->back()
            ->with('success', 'تم تحديث الخيار بنجاح');
    }

    public function destroy(MealOption $mealOption)
    {
        $mealOption->delete();

        return redirect()->back()
            ->with('success', 'تم حذف الخيار بنجاح');
    }
}
