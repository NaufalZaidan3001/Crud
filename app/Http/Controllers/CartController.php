<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Add an item to the basket/cart.
     */
    public function add(Request $request, Menu $menu)
    {
        // 1. Get the cart from session
        $cart = session()->get('cart', []);
        
        $quantity = (int) $request->input('quantity', 1);

        // 2. Multi-restaurant check (Option 1: Reject with error)
        if (!empty($cart)) {
            // Get the restaurant_id of the first item in the cart
            $existingRestaurantId = reset($cart)['restaurant_id'];
            
            if ($existingRestaurantId != $menu->restaurant_id) {
                return back()->with('error', 'You already have items from a different restaurant in your cart! Please checkout or clear your cart first.');
            }
        }

        // 3. Add to cart or increment
        if (isset($cart[$menu->id])) {
            $cart[$menu->id]['quantity'] += $quantity;
        } else {
            $cart[$menu->id] = [
                'name' => $menu->item_name,
                'price' => $menu->price,
                'quantity' => $quantity,
                'image' => $menu->image,
                'restaurant_id' => $menu->restaurant_id
            ];
        }

        session()->put('cart', $cart);

        return back()->with('success', 'Added "' . $menu->item_name . '" to your cart.');
    }

    /**
     * Remove an item from the basket/cart.
     */
    public function remove(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return back()->with('success', 'Item removed from cart.');
    }

    /**
     * Clear the entire cart.
     */
    public function clear()
    {
        session()->forget('cart');
        return back()->with('success', 'Cart cleared.');
    }

    /**
     * Checkout: convert cart to an Order in DB.
     */
    public function checkout(Request $request)
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return back()->with('error', 'Your cart is empty.');
        }

        $restaurantId = reset($cart)['restaurant_id'];
        $totalPrice = 0;
        
        foreach ($cart as $id => $details) {
            $totalPrice += $details['price'] * $details['quantity'];
        }

        $order = Order::create([
            'user_id' => Auth::id(),
            'restaurant_id' => $restaurantId,
            'items' => json_encode($cart),
            'total_price' => $totalPrice,
            'status' => 'pending'
        ]);

        session()->forget('cart');

        return redirect()->route('order.index')->with('success', 'Order #' . $order->id . ' placed successfully!');
    }
}
