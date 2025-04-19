<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\PackageCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PackageCategoryController extends Controller
{
    public function index()
    {
        $categories = PackageCategory::all();
        $statistics = [
            'total_categories' => PackageCategory::count(),
            'active_categories' => PackageCategory::where('is_active', true)->count(),
            'inactive_categories' => PackageCategory::where('is_active', false)->count(),
        ];

        return view('admin.package_categories.index', compact('categories', 'statistics'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:package_categories',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('package_categories', 'public');
        }

        PackageCategory::create($data);

        return redirect()->route('package-categories.index')->with('success', 'تم إضافة الفئة بنجاح');
    }

    public function update(Request $request, PackageCategory $packageCategory)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:package_categories,name,' . $packageCategory->id,
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($packageCategory->image) {
                Storage::disk('public')->delete($packageCategory->image);
            }
            $data['image'] = $request->file('image')->store('package_categories', 'public');
        }

        $packageCategory->update($data);

        return redirect()->route('package-categories.index')->with('success', 'تم تحديث الفئة بنجاح');
    }

    public function destroy(PackageCategory $packageCategory)
    {
        // Delete image if exists
        if ($packageCategory->image) {
            Storage::disk('public')->delete($packageCategory->image);
        }

        $packageCategory->delete();

        return redirect()->route('package-categories.index')->with('success', 'تم حذف الفئة بنجاح');
    }
}
