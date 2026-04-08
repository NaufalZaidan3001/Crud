@props(['restaurant'])

<div class="card" style="border-radius: 10px; overflow: hidden; transition: box-shadow 0.2s;">
    {{-- Restaurant image placeholder --}}
    <div style="height: 140px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center;">
        <i class="icon-store icon-3x" style="color: rgba(255,255,255,0.7);"></i>
    </div>

    <div class="card-body">
        <h6 class="card-title font-weight-bold mb-1">{{ $restaurant->restaurant_name }}</h6>
        <p class="text-muted font-size-sm mb-2" style="min-height: 36px; overflow: hidden;">
            {{ Str::limit($restaurant->description, 60, '...') ?? 'No description available.' }}
        </p>

        @if($restaurant->address)
        <p class="font-size-sm text-muted mb-2">
            <i class="icon-location3 mr-1"></i> {{ Str::limit($restaurant->address, 40, '...') }}
        </p>
        @endif

        <div class="d-flex align-items-center justify-content-between mt-3">
            <span class="badge badge-success badge-pill">Open</span>
            <a href="{{ route('menu.index', ['restaurant' => $restaurant->id]) }}"
               class="btn btn-sm btn-primary rounded-pill px-3"
               id="view-restaurant-{{ $restaurant->id }}-btn">
                View Menu
            </a>
        </div>
    </div>
</div>
