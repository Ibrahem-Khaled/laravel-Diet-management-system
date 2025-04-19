<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::all();

        $statistics = [
            'total_users' => User::count(),
            'active_users' => User::whereNotNull('email_verified_at')->count(),
            'male_users' => User::where('gender', 'male')->count(),
            'female_users' => User::where('gender', 'female')->count(),
            'other_gender' => User::where('gender', 'other')->count(),
            'recent_users' => User::where('created_at', '>', now()->subDays(7))->count(),
        ];

        return view('admin.users.index', compact('users', 'statistics'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:users,email',
            'phone' => 'required|unique:users,phone',
            'password' => 'nullable|string|min:6',
            'address' => 'nullable|string',
            'gender' => 'nullable|in:male,female,other',
            'birth_date' => 'nullable|date',
            'height' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'health_notes' => 'nullable|string',
        ]);

        $userData = $request->all();
        if ($request->filled('password')) {
            $userData['password'] = bcrypt($request->password);
        } else {
            unset($userData['password']);
        }

        User::create($userData);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:users,email,' . $user->id,
            'phone' => 'required|unique:users,phone,' . $user->id,
            'password' => 'nullable|string|min:6',
            'address' => 'nullable|string',
            'gender' => 'nullable|in:male,female,other',
            'birth_date' => 'nullable|date',
            'height' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'health_notes' => 'nullable|string',
        ]);

        $userData = $request->all();
        if ($request->filled('password')) {
            $userData['password'] = bcrypt($request->password);
        } else {
            unset($userData['password']);
        }

        $user->update($userData);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
