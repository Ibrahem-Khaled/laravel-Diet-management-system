<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\PackageCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::with('category')->get();
        $categories = PackageCategory::where('is_active', true)->get();

        $statistics = [
            'total_packages' => Package::count(),
            'active_packages' => Package::where('is_active', true)->count(),
            'inactive_packages' => Package::where('is_active', false)->count(),
        ];

        return view('admin.packages.index', compact('packages', 'statistics', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:package_categories,id',
            'days_count' => 'required|integer|min:1',
            'special_conditions' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric|min:0',
            'max_meals' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('packages', 'public');
        }

        Package::create($data);

        return redirect()->route('packages.index')->with('success', 'تم إضافة الباقة بنجاح');
    }

    public function update(Request $request, Package $package)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:package_categories,id',
            'days_count' => 'required|integer|min:1',
            'special_conditions' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric|min:0',
            'max_meals' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($package->image) {
                Storage::disk('public')->delete($package->image);
            }
            $data['image'] = $request->file('image')->store('packages', 'public');
        }

        $package->update($data);

        return redirect()->route('packages.index')->with('success', 'تم تحديث الباقة بنجاح');
    }

    public function destroy(Package $package)
    {
        // Delete image if exists
        if ($package->image) {
            Storage::disk('public')->delete($package->image);
        }

        $package->delete();

        return redirect()->route('packages.index')->with('success', 'تم حذف الباقة بنجاح');
    }
}
