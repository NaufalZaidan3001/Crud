<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AdminLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.admin-login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            
            // Check if user has admin role - adjust this based on your user model
            // Option 1: If using roles
            if (method_exists($user, 'hasRole') && $user->hasRole('admin')) {
                $request->session()->regenerate();
                return redirect()->intended('/admin/dashboard');
            }
            // // Option 2: If using a simple admin flag
            // elseif ($user->is_admin ?? false) {
            //     $request->session()->regenerate();
            //     return redirect()->intended('/admin/dashboard');
            // }
            // // Option 3: If using role column
            elseif ($user->role === 'admin') {
                $request->session()->regenerate();
                return redirect()->intended('/admin/dashboard');
            }
            else {
                Auth::logout();
                throw ValidationException::withMessages([
                    'email' => 'You do not have admin privileges.',
                ]);
            }
        }

        throw ValidationException::withMessages([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
}
