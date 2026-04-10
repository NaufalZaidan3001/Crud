{{-- components/layout/navbar.blade.php --}}
<div class="navbar navbar-expand-md navbar-dark bg-indigo navbar-static">
    <div class="navbar-brand">
        <a href="{{ url('/') }}" class="d-inline-block">
            <img src="{{ asset('global_assets/images/rsz_logo-og.png') }}" alt="">
        </a>
    </div>

    <div class="d-md-none">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
            <i class="icon-tree5"></i>
        </button>
        <button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
            <i class="icon-paragraph-justify3"></i>
        </button>
    </div>

    <div class="collapse navbar-collapse" id="navbar-mobile">
        <x-navbar-collapse />

        <span class="navbar-text ml-md-3">
            <span class="badge badge-mark border-orange-300 mr-2"></span>
            Welcome, {{ Auth::check() ? (Auth::user()->role === 'restaurant' ? (Auth::user()->restaurant->restaurant_name ?? Auth::user()->name) : Auth::user()->name) : 'Guest' }}!
        </span>

        <ul class="navbar-nav ml-md-auto">
            @auth
            @if(Auth::user()->role !== 'restaurant')
            <li class="nav-item dropdown">
                @php $cart = session('cart', []); $cartCount = collect($cart)->sum('quantity'); $cartTotal = collect($cart)->sum(function($item) { return $item['price'] * $item['quantity']; }); @endphp
                <a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-cart2 mr-2"></i>
                    Cart
                    @if($cartCount > 0)
                    <span class="badge badge-pill bg-warning-400 ml-1">{{ $cartCount }}</span>
                    @endif
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-content wmin-md-350">
                    <div class="dropdown-content-header pb-1 border-bottom">
                        <span class="font-weight-semibold">Your Cart</span>
                    </div>

                    <div class="dropdown-content-body dropdown-scrollable p-0">
                        <ul class="media-list">
                            @forelse($cart as $id => $details)
                            <li class="media p-2 border-bottom">
                                <div class="mr-3">
                                    @if($details['image'])
                                    <img src="{{ asset('storage/' . $details['image']) }}" width="40" height="40" class="rounded" alt="" style="object-fit: cover;">
                                    @else
                                    <div class="bg-light rounded d-flex align-items-center justify-content-center text-muted" style="width: 40px; height: 40px;"><i class="icon-image2"></i></div>
                                    @endif
                                </div>
                                <div class="media-body">
                                    <div class="font-weight-semibold">{{ $details['name'] }}</div>
                                    <div class="text-muted font-size-sm">{{ $details['quantity'] }} x Rp {{ number_format($details['price'], 0, ',', '.') }}</div>
                                </div>
                                <div class="ml-2 align-self-center">
                                    <form action="{{ route('basket.remove', $id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-link text-danger p-0" title="Remove"><i class="icon-cross3"></i></button>
                                    </form>
                                </div>
                            </li>
                            @empty
                            <li class="p-3 text-center text-muted">
                                <i class="icon-cart text-grey-300 icon-2x d-block mb-2"></i>
                                Your cart is empty!
                            </li>
                            @endforelse
                        </ul>
                    </div>

                    @if($cartCount > 0)
                    <div class="dropdown-content-footer bg-light p-2 d-flex justify-content-between align-items-center">
                        <span class="font-weight-bold">Total: Rp {{ number_format($cartTotal, 0, ',', '.') }}</span>
                        <div class="d-flex">
                            <form action="{{ route('basket.clear') }}" method="POST" class="mr-2">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-light">Clear</button>
                            </form>
                            <form action="{{ route('basket.checkout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-primary">Checkout</button>
                            </form>
                        </div>
                    </div>
                    @endif
                </div>
            </li>
            @endif
            <li class="nav-item">
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <a href="#" class="navbar-nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="icon-switch2"></i>
                    <span class="ml-2">Logout</span>
                </a>
            </li>
            @endauth
        </ul>
    </div>
</div>