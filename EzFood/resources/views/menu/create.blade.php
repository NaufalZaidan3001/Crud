<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Add Menu Item</title>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 min-h-screen">

<div class="container mx-auto mt-10 mb-10 px-6 max-w-2xl">

    <div class="mb-6">
        <a href="{{ route('menu.index') }}" class="text-blue-600 text-sm hover:underline">&larr; Back to Menu</a>
        <h1 class="text-3xl font-bold text-gray-800 mt-2">Add Menu Item</h1>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-8">
        <form action="{{ route('menu.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Item Name --}}
            <div class="mb-5">
                <label for="item_name" class="block text-sm font-medium text-gray-700 mb-1">Item Name <span class="text-red-500">*</span></label>
                <input type="text" name="item_name" id="item_name"
                       value="{{ old('item_name') }}"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('item_name') border-red-500 @enderror"
                       placeholder="e.g. Nasi Goreng Spesial">
                @error('item_name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Description --}}
            <div class="mb-5">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea name="description" id="description" rows="3"
                          class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('description') border-red-500 @enderror"
                          placeholder="Describe the dish...">{{ old('description') }}</textarea>
                @error('description')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Price --}}
            <div class="mb-5">
                <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Price (Rp) <span class="text-red-500">*</span></label>
                <input type="number" name="price" id="price"
                       value="{{ old('price') }}"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('price') border-red-500 @enderror"
                       placeholder="e.g. 25000" min="0" step="500">
                @error('price')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Image --}}
            <div class="mb-5">
                <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Image</label>
                <input type="file" name="image" id="image" accept="image/*"
                       class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                @error('image')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Availability --}}
            <div class="mb-6 flex items-center gap-3">
                <input type="checkbox" name="availability" id="availability" value="1"
                       {{ old('availability', true) ? 'checked' : '' }}
                       class="w-4 h-4 text-blue-600 rounded border-gray-300 focus:ring-blue-500">
                <label for="availability" class="text-sm font-medium text-gray-700">Available for ordering</label>
            </div>

            <div class="flex justify-end gap-3">
                <a href="{{ route('menu.index') }}"
                   class="px-5 py-2.5 text-sm text-gray-600 bg-gray-100 rounded-full hover:bg-gray-200 transition">
                    Cancel
                </a>
                <button type="submit" id="submit-create-btn"
                        class="px-5 py-2.5 text-sm text-white bg-blue-600 rounded-full hover:bg-blue-700 transition shadow">
                    Add Item
                </button>
            </div>
        </form>
    </div>
</div>

</body>
</html>
