<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Menu List</title>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
</head>

<body class="bg-gray-100 min-h-screen">

    <div class="container mx-auto mt-10 mb-10 px-6">

        {{-- Page Header --}}
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold text-gray-800">
                @if(Auth::user()->role === 'restaurant') My Menu @else Browse Menu @endif
            </h1>

            @if(Auth::user()->role === 'restaurant')
            <a href="{{ route('menu.create') }}"
                class="px-5 py-2.5 bg-blue-600 text-white text-sm font-medium rounded-full shadow hover:bg-blue-700 transition"
                id="add-menu-btn">
                + Add Menu Item
            </a>
            @endif
        </div>

        {{-- Flash Message --}}
        @if(session('success'))
        <div class="mb-4 p-4 rounded-lg bg-green-100 text-green-800 border border-green-300">
            {{ session('success') }}
        </div>
        @endif

        {{-- Menu Grid (Customer View) --}}
        @if(Auth::user()->role !== 'restaurant')
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($menus as $menu)
            <div class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-md transition">
                @if($menu->image)
                <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->item_name }}"
                    class="w-full h-48 object-cover">
                @else
                <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-400 text-sm">No Image</div>
                @endif

                <div class="p-4">
                    <h3 class="font-semibold text-gray-800 text-lg">{{ $menu->item_name }}</h3>
                    <p class="text-gray-500 text-sm mt-1 line-clamp-2">{{ $menu->description ?? 'No description.' }}</p>
                    <div class="flex items-center justify-between mt-4">
                        <span class="text-blue-600 font-bold">Rp {{ number_format($menu->price, 0, ',', '.') }}</span>
                        <a href="{{ route('menu.show', $menu) }}"
                            class="px-4 py-2 bg-blue-600 text-white text-xs font-medium rounded-full hover:bg-blue-700 transition"
                            id="view-menu-{{ $menu->id }}-btn">
                            View Details
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-3 text-center py-16 text-gray-400">No menu items available.</div>
            @endforelse
        </div>

        {{-- Menu Table (Restaurant View) --}}
        @else
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-600">
                    <thead class="bg-gray-50 text-xs uppercase text-gray-500 border-b">
                        <tr>
                            <th class="px-6 py-4">No</th>
                            <th class="px-6 py-4">Item Name</th>
                            <th class="px-6 py-4">Price</th>
                            <th class="px-6 py-4">Availability</th>
                            <th class="px-6 py-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($menus as $menu)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 font-medium text-gray-800">{{ $menu->item_name }}</td>
                            <td class="px-6 py-4">Rp {{ number_format($menu->price, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">
                                @if($menu->availability)
                                <span class="px-2 py-1 text-xs bg-green-100 text-green-700 rounded-full">Available</span>
                                @else
                                <span class="px-2 py-1 text-xs bg-red-100 text-red-700 rounded-full">Unavailable</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('menu.show', $menu) }}"
                                        id="show-menu-{{ $menu->id }}-btn"
                                        class="px-3 py-1.5 bg-gray-100 text-gray-700 text-xs rounded-full hover:bg-gray-200 transition">
                                        View
                                    </a>
                                    <a href="{{ route('menu.edit', $menu) }}"
                                        id="edit-menu-{{ $menu->id }}-btn"
                                        class="px-3 py-1.5 bg-blue-100 text-blue-700 text-xs rounded-full hover:bg-blue-200 transition">
                                        Edit
                                    </a>
                                    <form action="{{ route('menu.destroy', $menu) }}" method="POST"
                                        onsubmit="return confirm('Delete this menu item?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            id="delete-menu-{{ $menu->id }}-btn"
                                            class="px-3 py-1.5 bg-red-100 text-red-700 text-xs rounded-full hover:bg-red-200 transition">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-gray-400">No menu items yet.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @endif

        {{-- Pagination --}}
        <div class="mt-6">
            {{ $menus->links() }}
        </div>
    </div>

</body>

</html>