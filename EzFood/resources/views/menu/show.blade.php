<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $menu->item_name }}</title>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
</head>
<x-head title="Menu Item" />

<body class="bg-gray-100 min-h-screen">

    <div class="container mx-auto mt-10 mb-10 px-6 max-w-2xl">

        <div class="mb-6">
            <a href="{{ route('menu.index') }}" class="text-blue-600 text-sm hover:underline">&larr; Back to Menu</a>
        </div>

        <div class="bg-white rounded-xl shadow-sm overflow-hidden">

            {{-- Menu Image --}}
            @if($menu->image)
            <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->item_name }}"
                class="w-full h-64 object-cover">
            @else
            <div class="w-full h-64 bg-gray-200 flex items-center justify-center text-gray-400">No Image</div>
            @endif

            <div class="p-8">
                <div class="flex items-start justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">{{ $menu->item_name }}</h1>
                        <p class="text-sm text-gray-500 mt-1">
                            by <span class="font-medium">{{ $menu->restaurant->restaurant_name ?? 'Unknown Restaurant' }}</span>
                        </p>
                    </div>
                    <span class="text-xl font-bold text-blue-600">
                        Rp {{ number_format($menu->price, 0, ',', '.') }}
                    </span>
                </div>

                <p class="text-gray-600 mt-4 leading-relaxed">
                    {{ $menu->description ?? 'No description provided.' }}
                </p>

                <div class="mt-4">
                    @if($menu->availability)
                    <span class="px-3 py-1 text-xs bg-green-100 text-green-700 rounded-full font-medium">Available</span>
                    @else
                    <span class="px-3 py-1 text-xs bg-red-100 text-red-700 rounded-full font-medium">Currently Unavailable</span>
                    @endif
                </div>

                <div class="mt-8 flex gap-3">

                    {{-- Customer: Add to Basket --}}
                    @if(Auth::user()->role === 'customer' && $menu->availability)
                    <form action="{{ route('basket.add', $menu) }}" method="POST">
                        @csrf
                        <div class="flex items-center gap-3 mb-4">
                            <label for="quantity" class="text-sm font-medium text-gray-700">Qty:</label>
                            <input type="number" name="quantity" id="quantity" value="1" min="1"
                                class="w-20 border border-gray-300 rounded-lg px-3 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <button type="submit" id="add-to-basket-btn"
                            class="px-6 py-3 bg-blue-600 text-white text-sm font-medium rounded-full shadow hover:bg-blue-700 transition">
                            🛒 Add to Basket
                        </button>
                    </form>
                    @endif

                    {{-- Restaurant: Edit & Delete --}}
                    @if(Auth::user()->role === 'restaurant' && Auth::user()->restaurant?->id === $menu->restaurant_id)
                    <a href="{{ route('menu.edit', $menu) }}"
                        id="edit-menu-show-btn"
                        class="px-5 py-2.5 bg-blue-100 text-blue-700 text-sm font-medium rounded-full hover:bg-blue-200 transition">
                        Edit Item
                    </a>
                    <form action="{{ route('menu.destroy', $menu) }}" method="POST"
                        onsubmit="return confirm('Delete this menu item?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" id="delete-menu-show-btn"
                            class="px-5 py-2.5 bg-red-100 text-red-700 text-sm font-medium rounded-full hover:bg-red-200 transition">
                            Delete
                        </button>
                    </form>
                    @endif

                </div>
            </div>
        </div>
    </div>

</body>

</html>