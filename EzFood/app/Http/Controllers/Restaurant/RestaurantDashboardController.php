<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RestaurantDashboardController extends Controller
{
    public function index(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $restaurant = $user->restaurant;

        if ($request->ajax()) {
            if (!$restaurant) {
                return DataTables::of(collect())->make(true);
            }
            
            $query = Menu::where('restaurant_id', $restaurant->id);

            return Datatables::of($query)
                ->addColumn('price_formatted', function ($menu) {
                    return 'Rp ' . number_format($menu->price, 0, ',', '.');
                })
                ->addColumn('availability_badge', function ($menu) {
                    if ($menu->availability) {
                        return '<span class="badge badge-success">Available</span>';
                    } else {
                        return '<span class="badge badge-danger">Unavailable</span>';
                    }
                })
                ->addColumn('actions', function ($menu) {
                    $showUrl = route('menu.show', $menu);
                    $editUrl = route('menu.edit', $menu);
                    $deleteUrl = route('menu.destroy', $menu);
                    $csrf = csrf_field();
                    $method = method_field('DELETE');
                    
                    return '
                        <a href="'.$showUrl.'" class="btn btn-sm btn-light rounded-pill mr-1">View</a>
                        <a href="'.$editUrl.'" class="btn btn-sm btn-info rounded-pill mr-1">Edit</a>
                        <form action="'.$deleteUrl.'" method="POST" class="d-inline" onsubmit="return confirm(\'Delete this item?\')">
                            '.$csrf.'
                            '.$method.'
                            <button type="submit" class="btn btn-sm btn-danger rounded-pill">Delete</button>
                        </form>
                    ';
                })
                ->rawColumns(['availability_badge', 'actions'])
                ->make(true);
        }

        return view('restaurant.dashboard', compact('restaurant'));
    }
}
