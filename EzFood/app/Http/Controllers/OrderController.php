<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\OrderExport;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        if ($request->ajax()) {
            if ($user->role === 'restaurant' && $user->restaurant) {
                $query = Order::with('restaurant', 'user')->where('restaurant_id', $user->restaurant->id);
            } else {
                $query = Order::with('restaurant', 'user')->where('user_id', $user->id);
            }

            return Datatables::of($query)
                ->addColumn('restaurant_name', function ($order) {
                    return $order->restaurant->restaurant_name ?? 'Unknown';
                })
                ->filterColumn('restaurant_name', function($query, $keyword) {
                    $query->whereHas('restaurant', function($q) use($keyword) {
                        $q->where('restaurant_name', 'like', "%{$keyword}%");
                    });
                })
                ->addColumn('total_formatted', function ($order) {
                    return 'Rp ' . number_format($order->total_price, 0, ',', '.');
                })
                ->addColumn('status_badge', function ($order) {
                    $color = $order->status === 'completed' ? 'success' : ($order->status === 'pending' ? 'warning' : 'danger');
                    return '<span class="badge badge-' . $color . '">' . ucfirst($order->status) . '</span>';
                })
                ->addColumn('actions', function ($order) {
                    return '<a href="' . route('order.show', $order) . '" class="btn btn-sm btn-primary rounded-pill">View Details</a>';
                })
                ->rawColumns(['status_badge', 'actions'])
                ->make(true);
        }

        return view('user.order-index');
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

    public function accept(Order $order)
    {
        $user = Auth::user();

        if ($user->role !== 'restaurant' || $order->restaurant_id !== $user->restaurant?->id) {
            abort(403);
        }

        $order->update(['status' => 'completed']);

        return redirect()->route('order.show', $order)->with('success', 'Order accepted successfully.');
    }

    public function cancel(Order $order)
    {
        $user = Auth::user();

        if ($user->role !== 'restaurant' || $order->restaurant_id !== $user->restaurant?->id) {
            abort(403);
        }

        $order->update(['status' => 'cancelled']);

        return redirect()->route('order.show', $order)->with('success', 'Order cancelled.');
    }

    public function exportPdf(Order $order)
    {
        $pdf = Pdf::loadView('exports.order-pdf', compact('order'));
        return $pdf->download('Invoice_Order_' . $order->id . '.pdf');
    }

    public function exportExcel(Order $order)
    {
        return Excel::download(new OrderExport($order), 'Invoice_Order_' . $order->id . '.xlsx');
    }
}

