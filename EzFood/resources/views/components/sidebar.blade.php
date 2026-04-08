            <!-- Sidebar content -->
            <div class="sidebar-content">

                <!-- User menu -->
                <div class="sidebar-user">
                    <div class="card-body">
                        <div class="media">
                            <div class="mr-3">
                                <a href="#">
                                    <img src="{{ asset('global_assets/images/placeholders/placeholder.jpg') }}" width="38" height="38" class="rounded-circle" alt="">
                                </a>
                            </div>

                            <div class="media-body">
                                <div class="media-title font-weight-semibold">{{ Auth::user()->name }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /sidebar content -->