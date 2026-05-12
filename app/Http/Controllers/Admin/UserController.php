<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Notifications\StatusUpdate;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::with('role');

        if ($request->filled('role')) {
            $role = Role::where('slug', $request->role)->first();
            if ($role) $query->where('role_id', $role->id);
        }

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%'.$request->search.'%')
                  ->orWhere('email', 'like', '%'.$request->search.'%');
            });
        }

        $users = $query->latest()->paginate(20)->withQueryString();
        $roles = Role::all();
        return view('admin.users.index', compact('users', 'roles'));
    }

    public function suspend(User $user)
    {
        $user->update(['status' => 'suspended']);
        $user->notify(new StatusUpdate(
            'Account Suspended',
            "Your account has been suspended by the administrator.",
            url('/suspended')
        ));
        return back()->with('success', "User {$user->name} has been suspended.");
    }

    public function activate(User $user)
    {
        $user->update(['status' => 'active']);
        $user->notify(new StatusUpdate(
            'Account Activated',
            "Your account has been activated! You can now access all features.",
            url('/login')
        ));
        return back()->with('success', "User {$user->name} has been activated.");
    }
}
