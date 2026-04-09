                <!-- /user menu -->

                <!-- Main navigation -->
                <div class="card card-sidebar-mobile">
                    <ul class="nav nav-sidebar" data-nav-type="accordion">

                        <!-- Main -->
                        <li class="nav-item-header">
                            <div class="text-uppercase font-size-xs line-height-xs">Main</div>
                        </li>
                        <li class="nav-item">
                            @if(Auth::check() && Auth::user()->role === 'restaurant')
                            <a href="{{ route('restaurant.dashboard') }}" class="nav-link {{ request()->routeIs('restaurant.dashboard') ? 'active' : '' }}">
                                <i class="icon-home4"></i> <span>Restaurant Dashboard</span>
                            </a>
                            @elseif(Auth::check() && Auth::user()->role === 'admin')
                            <a href="{{ route('admin.approval') }}" class="nav-link {{ request()->routeIs('admin.approval') ? 'active' : '' }}">
                                <i class="icon-shield-check"></i> <span>Admin Dashboard</span>
                            </a>
                            @else
                            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                                <i class="icon-home4"></i>
                                <span>Restaurant</span>
                            </a>
                            @endif
                        </li>
                        @if(Auth::check() && Auth::user()->role === 'restaurant')
                        <li class="nav-item">
                            <a href="{{ route('menu.index') }}" class="nav-link {{ request()->routeIs('menu.*') ? 'active' : '' }}">
                                <i class="icon-list"></i>
                                <span>Menu</span>
                            </a>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a href="{{ route('order.index') }}" class="nav-link {{ request()->routeIs('order.*') ? 'active' : '' }}">
                                <i class="icon-cart2"></i>
                                <span>Orders</span>
                            </a>
                        </li>

                        <!-- /main -->

                    </ul>
                </div>
                <!-- /main navigation -->