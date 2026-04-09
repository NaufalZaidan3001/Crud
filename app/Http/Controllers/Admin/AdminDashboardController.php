<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalRestaurants = Restaurant::count();
        $pendingRestaurants = Restaurant::where('status', 'pending')->count();
        $approvedRestaurants = Restaurant::where('status', 'approved')->count();
        $rejectedRestaurants = Restaurant::where('status', 'rejected')->count();

        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $completedOrders = Order::where('status', 'completed')->count();
        $cancelledOrders = Order::where('status', 'cancelled')->count();

        $restaurants = Restaurant::with('user')->get();
        $order = Order::with(['user', 'restaurant'])->get();

        return view('admin.dashboard', compact(
            'totalRestaurants',
            'pendingRestaurants',
            'approvedRestaurants',
            'rejectedRestaurants',
            'totalOrders',
            'pendingOrders',
            'completedOrders',
            'cancelledOrders',
            'restaurants',
            'order'
        ));
    }
    public function approveRestaurant($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $restaurant->status = 'approved';
        $restaurant->save();

        return redirect()->route('admin.dashboard')->with('success', 'Restaurant approved successfully.');
    }
    public function rejectRestaurant($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $restaurant->status = 'rejected';
        $restaurant->save();

        return redirect()->route('admin.dashboard')->with('success', 'Restaurant rejected successfully.');
    }
    public function updateOrderStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = $request->input('status');
        $order->save();

        return redirect()->route('admin.dashboard')->with('success', 'Order status updated successfully.');
    }
}

