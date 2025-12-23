<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AdminAuthController extends Controller
{
    public function create()
    {
        return view('admin.auth.login');
    }

    public function store(Request $request)
    {
        \Illuminate\Support\Facades\Log::info('Admin Login Attempt: ' . $request->email);

        $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            \Illuminate\Support\Facades\Log::warning('Admin Login Failed: Auth::attempt returned false');
            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        // Check if user is actually an admin
        if (Auth::user()->role !== 'admin') {
            \Illuminate\Support\Facades\Log::warning('Admin Login Failed: Role mismatch (' . Auth::user()->role . ')');
            Auth::logout();
            
            throw ValidationException::withMessages([
                'email' => 'Access denied. Administrators only.',
            ]);
        }

        \Illuminate\Support\Facades\Log::info('Admin Login Success for: ' . $request->email);
        $request->session()->regenerate();

        return redirect()->route('admin.dashboard');
    }

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }
}
