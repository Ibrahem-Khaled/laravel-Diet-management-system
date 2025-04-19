<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index()
    {
        $subscriptions = Subscription::with(['user', 'package'])->latest()->get();

        $stats = [
            'total' => Subscription::count(),
            'active' => Subscription::whereDate('start_date', '<=', now())
                ->whereDate('start_date', '>=', now()->subDays(30))
                ->count(),
            'expiring' => Subscription::whereDate('start_date', '<=', now()->subDays(25))
                ->whereDate('start_date', '>=', now()->subDays(30))
                ->count(),
            'new_today' => Subscription::whereDate('created_at', today())->count()
        ];

        return view('admin.subscriptions.index', compact('subscriptions', 'stats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'package_id' => 'required|exists:packages,id',
            'start_date' => 'required|date',
            'meal_lock_hours' => 'required|integer|min:1|max:72'
        ]);

        Subscription::create($request->all());

        return redirect()->route('subscriptions.index')
            ->with('success', 'تم إضافة الاشتراك بنجاح');
    }

    public function update(Request $request, Subscription $subscription)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'package_id' => 'required|exists:packages,id',
            'start_date' => 'required|date',
            'meal_lock_hours' => 'required|integer|min:1|max:72'
        ]);

        $subscription->update($request->all());

        return redirect()->route('subscriptions.index')
            ->with('success', 'تم تحديث الاشتراك بنجاح');
    }

    public function destroy(Subscription $subscription)
    {
        $subscription->delete();

        return redirect()->route('subscriptions.index')
            ->with('success', 'تم حذف الاشتراك بنجاح');
    }
}
