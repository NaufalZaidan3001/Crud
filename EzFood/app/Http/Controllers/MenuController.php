<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    /**
     * Display a listing of menu items.
     * Restaurant: sees only their own items.
     * Customer: sees all available items.
     */
    public function index(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($user->role === 'restaurant') {
            $restaurant = $user->restaurant;
            $menus = $restaurant
                ? Menu::where('restaurant_id', $restaurant->id)->latest()->paginate(10)
                : collect();
        } else {
            // Customers can filter by a specific restaurant
            $query = Menu::where('availability', true)->latest();

            if ($request->filled('restaurant')) {
                $query->where('restaurant_id', $request->integer('restaurant'));
            }

            $menus = $query->paginate(10)->withQueryString();
        }

        return view('menu.index', compact('menus'));
    }

    /**
     * Show the form for creating a new menu item (restaurant only).
     */
    public function create()
    {
        $this->authorizeRestaurant();
        return view('menu.create');
    }

    /**
     * Store a newly created menu item in storage.
     */
    public function store(Request $request)
    {
        $this->authorizeRestaurant();

        $validated = $request->validate([
            'item_name'   => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'availability'=> 'boolean',
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $validated['restaurant_id'] = $user->restaurant->id;
        $validated['availability'] = $request->has('availability');

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('menu_images', 'public');
        }

        Menu::create($validated);

        return redirect()->route('menu.index')->with('success', 'Menu item added successfully.');
    }

    /**
     * Display the specified menu item.
     */
    public function show(Menu $menu)
    {
        return view('menu.show', compact('menu'));
    }

    /**
     * Show the form for editing a menu item (restaurant owner only).
     */
    public function edit(Menu $menu)
    {
        $this->authorizeRestaurant();
        $this->authorizeOwner($menu);
        return view('menu.edit', compact('menu'));
    }

    /**
     * Update the specified menu item in storage.
     */
    public function update(Request $request, Menu $menu)
    {
        $this->authorizeRestaurant();
        $this->authorizeOwner($menu);

        $validated = $request->validate([
            'item_name'   => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'availability'=> 'boolean',
        ]);

        $validated['availability'] = $request->has('availability');

        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($menu->image) {
                Storage::disk('public')->delete($menu->image);
            }
            $validated['image'] = $request->file('image')->store('menu_images', 'public');
        }

        $menu->update($validated);

        return redirect()->route('menu.index')->with('success', 'Menu item updated successfully.');
    }

    /**
     * Remove the specified menu item from storage.
     */
    public function destroy(Menu $menu)
    {
        $this->authorizeRestaurant();
        $this->authorizeOwner($menu);

        if ($menu->image) {
            Storage::disk('public')->delete($menu->image);
        }

        $menu->delete();

        return redirect()->route('menu.index')->with('success', 'Menu item deleted successfully.');
    }

    /**
     * Abort if the current user is not a restaurant owner.
     */
    private function authorizeRestaurant(): void
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        if ($user->role !== 'restaurant') {
            abort(403, 'Only restaurant owners can manage menu items.');
        }
    }

    /**
     * Abort if the current restaurant owner does not own this menu item.
     */
    private function authorizeOwner(Menu $menu): void
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        if ($menu->restaurant_id !== $user->restaurant->id) {
            abort(403, 'You do not own this menu item.');
        }
    }
}
