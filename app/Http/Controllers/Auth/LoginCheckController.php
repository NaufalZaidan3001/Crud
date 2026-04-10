<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginCheckController extends Controller
{
    public function create()
    {
        return view('auth.welcome');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            $user = Auth::user();
            $request->session()->regenerate();

            if ($user->role === 'customer') {
                return redirect()->intended(route('dashboard'));
            } elseif ($user->role === 'restaurant') {
                // Check if restaurant is approved
                if ($user->restaurant && $user->restaurant->status === 'approved') {
                    return redirect()->intended(route('restaurant.dashboard'));
                }
                return redirect()->route('restaurant.pending');
            } elseif ($user->role === 'admin') {
                return redirect()->intended(route('admin.dashboard'));
            } else {
                Auth::logout();
                throw ValidationException::withMessages([
                    'email' => 'Unauthorized account role.',
                ]);
            }
        }

        throw ValidationException::withMessages([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
}
