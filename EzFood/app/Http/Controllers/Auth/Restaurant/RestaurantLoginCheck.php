<?php
namespace App\Http\Controllers\Auth\Restaurant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Restaurant;


class RestaurantLoginCheck extends Controller
{
    public function showRestaurantLogin()
    {
        return view('auth.restaurant-login');
    }

    public function loginRestaurant(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
         if (!Auth::attempt($credentials)) {
            return back()->withErrors([
                'email' => 'Invalid email or password.',
            ])->onlyInput('email');
        }

        $request->session()->regenerate();

        $user = Auth::user();

        if ($user->role !== 'restaurant') {
            Auth::logout();

            return back()->withErrors([
                'email' => 'This login page is only for restaurant accounts.',
            ]);
        }

        if (!$user->restaurant) {
            Auth::logout();

            return back()->withErrors([
                'email' => 'Restaurant profile not found.',
            ]);
        }

        if ($user->restaurant->status !== 'approved') {
            Auth::logout();

            return back()->withErrors([
                'email' => 'Your restaurant account is still pending admin approval.',
            ]);
        }

        // Restaurant users don't need email verification, go directly to dashboard
        return redirect()->route('restaurant.dashboard');
    }
}