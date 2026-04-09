            <!-- Sidebar content -->
            <div class="sidebar-content">

                <!-- User menu -->
                <div class="sidebar-user sidebar-resize-hide">
                    <div class="card-body">
                        <div class="media">
                            <div class="mr-3">
                                <a href="#">
                                    <img src="{{ asset('global_assets/images/placeholders/placeholder.jpg') }}" width="38" height="38" class="rounded-circle" alt="">
                                </a>
                            </div>

                            <div class="media-body sidebar-resize-hide" style="overflow: hidden;">
                                <div class="media-title font-weight-semibold text-truncate" title="{{ Auth::user()->role === 'restaurant' ? (Auth::user()->restaurant->restaurant_name ?? Auth::user()->name) : Auth::user()->name }}">
                                    {{ Auth::user()->role === 'restaurant' ? (Auth::user()->restaurant->restaurant_name ?? Auth::user()->name) : Auth::user()->name }}
                                </div>
                                <div class="font-size-xs opacity-50 text-truncate">
                                    <i class="icon-user font-size-sm"></i> &nbsp;{{ ucfirst(Auth::user()->role) }} Account
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /sidebar content -->