<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class Approval extends Controller
{
    public function index()
    {
        $pendingRestaurants = Restaurant::where('status', 'pending')->get();

        return view('admin.approval', compact('pendingRestaurants'));
    }

    public function approve($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $restaurant->status = 'approved';
        $restaurant->save();

        return redirect()->route('admin.approval')->with('success', 'Restaurant approved successfully.');
    }

    public function reject($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $restaurant->status = 'rejected';
        $restaurant->save();

        return redirect()->route('admin.approval')->with('success', 'Restaurant rejected successfully.');
    }
}