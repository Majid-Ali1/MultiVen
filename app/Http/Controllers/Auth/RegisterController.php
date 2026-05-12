<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'string', 'in:customer,vendor'],
        ]);

        $role = Role::where('slug', $request->role)->firstOrFail();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $role->id,
            'status' => in_array($role->slug, ['vendor', 'partner']) ? 'pending' : 'active',
        ]);

        Auth::login($user);

        return match($role->slug) {
            'vendor' => redirect()->route('verification.notice')->with('success', 'Registration successful! Your application is under review.'),
            default => redirect()->route('customer.dashboard')->with('success', 'Registration successful! Welcome to MultiVen.'),
        };
    }
}
