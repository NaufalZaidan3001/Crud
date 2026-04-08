<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;

class RestaurantDashboardController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $restaurant = $user->restaurant;

        $menus = $restaurant
            ? Menu::where('restaurant_id', $restaurant->id)->latest()->paginate(9)
            : collect();

        return view('restaurant.dashboard', compact('menus', 'restaurant'));
    }
}
