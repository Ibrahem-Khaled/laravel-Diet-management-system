<?php

use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\MealController;
use App\Http\Controllers\admin\MealOptionController;
use App\Http\Controllers\admin\MealPackageController;
use App\Http\Controllers\admin\PackageCategoryController;
use App\Http\Controllers\admin\PackageController;
use App\Http\Controllers\admin\SubscriptionController;
use App\Http\Controllers\admin\UsersController;
use App\Http\Controllers\webController;
use Illuminate\Support\Facades\Route;

Route::get('/', [webController::class, 'index'])->name('home');

Route::get('/user/login', function () {
    return view('login');
})->name('user.login');

Route::get('/packages', function () {
    return view('subscriptions');
})->name('packages');

Route::group(['middleware' => ['auth'], 'prefix' => 'admin'], function () {

    Route::get('/', function () {
        return view('admin.index');
    })->name('home.dashboard');

    Route::resource('users', UsersController::class);
    Route::resource('package-categories', PackageCategoryController::class);
    Route::resource('packages', PackageController::class);
    Route::resource('subscriptions', SubscriptionController::class);
    Route::resource('categories', CategoryController::class);

    Route::resource('meals', MealController::class);
    Route::resource('meal-options', MealOptionController::class);

    Route::resource('meal-packages', MealPackageController::class);
    Route::post('meal-packages/{package}/add-meal', [MealPackageController::class, 'addMeal'])->name('meal-packages.add-meal');
   
    Route::get('/orders', function () {
        $orders = collect([
            (object) [
                'id' => 1,
                'meal_name' => 'برجر لحم',
                'meal_category' => 'وجبات رئيسية',
                'meal_image' => null,
                'user_id' => 1,
                'user_name' => 'أحمد محمد',
                'total_price' => 35.50,
                'status' => 'completed',
                'notes' => 'بدون بصل',
                'created_at' => now()->subDays(2)
            ],
            (object) [
                'id' => 2,
                'meal_name' => 'سلطة سيزر',
                'meal_category' => 'سلطات',
                'meal_image' => 'meals/salad.jpg',
                'user_id' => 2,
                'user_name' => 'سارة عبدالله',
                'total_price' => 25.00,
                'status' => 'processing',
                'notes' => 'إضافة خل بلسمك',
                'created_at' => now()->subHours(3)
            ],
            (object) [
                'id' => 3,
                'meal_name' => 'تشيز كيك',
                'meal_category' => 'حلويات',
                'meal_image' => 'meals/cheesecake.jpg',
                'user_id' => 3,
                'user_name' => 'خالد سعيد',
                'total_price' => 18.75,
                'status' => 'pending',
                'notes' => null,
                'created_at' => now()->subHours(1)
            ],
            (object) [
                'id' => 4,
                'meal_name' => 'بيتزا خضار',
                'meal_category' => 'وجبات رئيسية',
                'meal_image' => 'meals/pizza.jpg',
                'user_id' => 4,
                'user_name' => 'لينا فارس',
                'total_price' => 42.00,
                'status' => 'rejected',
                'notes' => 'نفذت المكونات',
                'created_at' => now()->subDays(1)
            ],
            (object) [
                'id' => 5,
                'meal_name' => 'مشروب الطاقة',
                'meal_category' => 'مشروبات',
                'meal_image' => null,
                'user_id' => 5,
                'user_name' => 'نادر علي',
                'total_price' => 12.00,
                'status' => 'completed',
                'notes' => 'مثلج',
                'created_at' => now()->subHours(5)
            ]
        ]);

        // بيانات وهمية للمستخدمين
        $users = collect([
            (object) ['id' => 1, 'name' => 'أحمد محمد'],
            (object) ['id' => 2, 'name' => 'سارة عبدالله'],
            (object) ['id' => 3, 'name' => 'خالد سعيد'],
            (object) ['id' => 4, 'name' => 'لينا فارس'],
            (object) ['id' => 5, 'name' => 'نادر علي']
        ]);

        // إحصائيات وهمية
        $stats = [
            'completed' => 2,
            'pending' => 1,
            'processing' => 1,
            'rejected' => 1,
            'completed_percent' => 40,
            'pending_percent' => 20,
            'processing_percent' => 20,
            'rejected_percent' => 20
        ];

        return view('admin.orders', compact('orders', 'users', 'stats'));
    })->name('orders.index');
});









require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';