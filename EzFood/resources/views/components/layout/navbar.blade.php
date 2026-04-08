{{-- components/layout/navbar.blade.php --}}
<div class="navbar navbar-expand-md navbar-dark bg-indigo navbar-static">
    <div class="navbar-brand">
        <a href="{{ url('/') }}" class="d-inline-block">
            <img src="{{ asset('global_assets/images/logo_light.png') }}" alt="">
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
            Welcome, {{ Auth::check() ? Auth::user()->name : 'Guest' }}!
        </span>

        <ul class="navbar-nav ml-md-auto">
            @auth
            <li class="nav-item dropdown">
                <a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-user mr-2"></i>
                    Account
                </a>

                <div class="dropdown-menu dropdown-menu-right">
                    <a href="#" class="dropdown-item"><i class="icon-user"></i> Profile</a>
                    <a href="#" class="dropdown-item"><i class="icon-cog"></i> Settings</a>
                    <div class="dropdown-divider"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item"><i class="icon-switch2"></i> Logout</button>
                    </form>
                </div>
            </li>
            @endauth
        </ul>
    </div>
</div>
