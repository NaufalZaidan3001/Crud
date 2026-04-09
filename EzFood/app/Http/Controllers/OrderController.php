<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // If restaurant, fetch orders for their restaurant. If customer, fetch their personal orders.
        if ($user->role === 'restaurant' && $user->restaurant) {
            $orders = Order::with('restaurant', 'user')
                ->where('restaurant_id', $user->restaurant->id)
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        } else {
            $orders = Order::with('restaurant', 'user')
                ->where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        }

        return view('user.order-index', compact('orders'));
    }

    public function show(Order $order)
    {
        $user = Auth::user();

        // Ensure the user actually owns this order or is the restaurant that received it
        if ($user->role === 'customer' && $order->user_id !== $user->id) {
            abort(403);
        }
        if ($user->role === 'restaurant' && $order->restaurant_id !== $user->restaurant?->id) {
            abort(403);
        }

        return view('user.order-show', compact('order'));
    }
}
