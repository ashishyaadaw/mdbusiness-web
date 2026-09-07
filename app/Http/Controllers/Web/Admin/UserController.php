<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::with('userProfile')
            ->withCount('matters')
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->string('search');
                $query->where(function ($q) use ($search) {
                    $q->where('username', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('role'), fn ($query) => $query->where('role', $request->string('role')))
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        $user->load('userProfile');

        $matters = $user->matters()
            ->with('controller')
            ->latest()
            ->paginate(10);

        return view('admin.users.show', compact('user', 'matters'));
    }

    public function toggleVerified(User $user)
    {
        $user->update(['is_verified' => ! $user->is_verified]);

        return back()->with('status', "User {$user->username} is now ".($user->is_verified ? 'verified' : 'unverified').'.');
    }

    public function updateRole(Request $request, User $user)
    {
        $validated = $request->validate([
            'role' => 'required|in:user,staff,admin',
        ]);

        $user->update(['role' => $validated['role']]);

        return back()->with('status', "User {$user->username} role updated to {$validated['role']}.");
    }
}
