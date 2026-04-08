<!DOCTYPE html>
<html lang="en">

<x-layout.head title="Customer Dashboard" />

<body>

    <x-layout.navbar />

    <!-- Page content -->
    <div class="page-content">

        <x-layout.sidebar-panel />

        <!-- Main content -->
        <div class="content-wrapper">

            <x-layout.page-header title="Customer Dashboard" :breadcrumbs="['Customer Dashboard']" />

            <!-- Content area -->
            <div class="content">
                <div class="row">
                    <div class="col-xl-12">

                        <!-- Restaurant Listing -->
                        <div class="card">
                            <div class="card-header header-elements-sm-inline">
                                <h6 class="card-title font-weight-bold">
                                    <i class="icon-store mr-2 text-primary"></i> Available Restaurants
                                </h6>
                                <div class="header-elements">
                                    <span class="text-muted font-size-sm">{{ $restaurants->total() }} restaurant(s) found</span>
                                </div>
                            </div>

                            <div class="card-body">
                                @if($restaurants->isEmpty())
                                <div class="text-center py-5 text-muted">
                                    <i class="icon-store icon-3x d-block mb-3"></i>
                                    <p>No restaurants available yet.</p>
                                </div>
                                @else
                                <div class="row">
                                    @foreach($restaurants as $restaurant)
                                    <div class="col-sm-6 col-xl-4 mb-4">
                                        <x-restaurant-card :restaurant="$restaurant" />
                                    </div>
                                    @endforeach
                                </div>

                                <div class="mt-2">
                                    {{ $restaurants->links() }}
                                </div>
                                @endif
                            </div>
                        </div>
                        <!-- /restaurant listing -->

                    </div>
                </div>
            </div>
            <!-- /content area -->

            <x-layout.footer />

        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->

</body>

</html>