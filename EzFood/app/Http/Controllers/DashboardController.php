<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch only approved restaurants for customers to browse
        $restaurants = Restaurant::where('status', 'approved')
            ->latest()
            ->paginate(9);

        return view('user.dashboard', compact('restaurants'));
    }
}
