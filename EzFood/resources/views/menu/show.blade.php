<!DOCTYPE html>
<html lang="en">
<x-layout.head title="{{ $menu->item_name }}" />

<body>
    <x-layout.navbar />
    <div class="page-content">
        <x-layout.sidebar-panel />
        
        <div class="content-wrapper">
            <x-layout.page-header title="Item Details" :breadcrumbs="['Menu', 'Details']" />

            <div class="content">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <div class="card shadow-0 border-0 rounded-lg overflow-hidden">
                            @if($menu->image)
                                <img src="{{ asset('storage/' . $menu->image) }}" class="card-img-top" style="height: 300px; object-fit: cover; width: 100%;" alt="{{ $menu->item_name }}">
                            @else
                                <div style="height: 300px; background: #e0e0e0; display: flex; align-items: center; justify-content: center;">
                                    <span class="text-muted"><i class="icon-image2 icon-3x"></i></span>
                                </div>
                            @endif

                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <div>
                                        <h3 class="font-weight-bold mb-1">{{ $menu->item_name }}</h3>
                                        <p class="text-muted mb-0">by <span class="font-weight-semibold">{{ $menu->restaurant->restaurant_name ?? 'Unknown Restaurant' }}</span></p>
                                    </div>
                                    <h4 class="text-primary font-weight-bold mb-0">Rp {{ number_format($menu->price, 0, ',', '.') }}</h4>
                                </div>

                                <p class="text-muted font-size-lg mb-4">
                                    {{ $menu->description ?? 'No description provided.' }}
                                </p>

                                <div class="mb-4">
                                    @if($menu->availability)
                                        <span class="badge badge-success badge-pill font-size-sm">Available</span>
                                    @else
                                        <span class="badge badge-danger badge-pill font-size-sm">Currently Unavailable</span>
                                    @endif
                                </div>

                                <div class="d-flex align-items-center mt-3 pt-3 border-top">
                                    
                                    {{-- Customer: Add to Basket --}}
                                    @if(Auth::user()->role === 'customer' && $menu->availability)
                                    <form action="{{ route('basket.add', $menu) }}" method="POST" class="d-flex align-items-center">
                                        @csrf
                                        <div class="input-group mr-3" style="width: 140px;">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text font-weight-bold">Qty:</span>
                                            </div>
                                            <input type="number" name="quantity" id="quantity" value="1" min="1" class="form-control text-center">
                                        </div>
                                        <button type="submit" class="btn btn-primary rounded-pill font-weight-bold">
                                            <i class="icon-cart-add mr-2"></i> Add to Basket
                                        </button>
                                    </form>
                                    @endif

                                    {{-- Restaurant: Edit & Delete --}}
                                    @if(Auth::user()->role === 'restaurant' && Auth::user()->restaurant?->id === $menu->restaurant_id)
                                        <a href="{{ route('menu.edit', $menu) }}" class="btn btn-info rounded-pill font-weight-bold mr-2">
                                            <i class="icon-pencil5 mr-1"></i> Edit Item
                                        </a>
                                        <form action="{{ route('menu.destroy', $menu) }}" method="POST" onsubmit="return confirm('Delete this menu item?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger rounded-pill font-weight-bold">
                                                <i class="icon-trash mr-1"></i> Delete
                                            </button>
                                        </form>
                                    @endif

                                    <div class="ml-auto">
                                        <a href="{{ route('menu.index') }}" class="btn btn-light rounded-pill"><i class="icon-arrow-left52 mr-1"></i> Back</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <x-layout.footer />
        </div>
    </div>
</body>
</html>