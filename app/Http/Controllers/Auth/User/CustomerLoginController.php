<?php

namespace App\Http\Controllers\Auth\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class CustomerLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.welcome');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();

            // Check if user has customer role
            if ($user->role === 'customer') {
                $request->session()->regenerate();
                return redirect()->intended(route('dashboard'));
            } else {
                Auth::logout();
                throw ValidationException::withMessages([
                    'email' => 'You do not have customer privileges.',
                ]);
            }
        }

        throw ValidationException::withMessages([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
}
