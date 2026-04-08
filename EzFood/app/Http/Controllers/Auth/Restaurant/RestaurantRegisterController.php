<?php

namespace App\Http\Controllers\Auth\Restaurant;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RestaurantRegisterController extends Controller
{
    /**
     * Display the restaurant registration view.
     */
    public function create(): View
    {
        return view('auth.restaurant-register');
    }

    /**
     * Handle an incoming restaurant registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone' => ['required', 'string', 'max:20'],
            'restaurant_name' => ['required', 'string', 'max:255', 'unique:restaurants,restaurant_name'],
            'description' => ['nullable', 'string'],
            'address' => ['required', 'string'],
        ]);

        // Create user with restaurant role
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'restaurant',
            'phone' => $request->phone,
        ]);

        // Create restaurant with pending status (default from migration)
        $user->restaurant()->create([
            'restaurant_name' => $request->restaurant_name,
            'description' => $request->description,
            'address' => $request->address,
            'phone' => $request->phone,
            // status will be 'pending' by default from migration
        ]);

        event(new Registered($user));

        Auth::login($user);

        // Restaurant users don't need email verification, go directly to pending page
        return redirect(route('restaurant.pending'));
    }
}
