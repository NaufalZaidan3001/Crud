<!DOCTYPE html>
<html lang="en">

<x-layout.head title="Restaurant Dashboard" />

<body>

    <x-layout.navbar />

    <!-- Page content -->
    <div class="page-content">

        <x-layout.sidebar-panel />

        <!-- Main content -->
        <div class="content-wrapper">

            <x-layout.page-header title="Restaurant Dashboard" :breadcrumbs="['Dashboard']" />

            <!-- Content area -->
            <div class="content">
                <div class="row">
                    <div class="col-xl-12">

                        <!-- Restaurant Info Card -->
                        @if($restaurant)
                        <div class="card mb-4">
                            <div class="card-header header-elements-sm-inline">
                                <h6 class="card-title font-weight-bold">
                                    <i class="icon-store mr-2 text-primary"></i> {{ $restaurant->restaurant_name }}
                                </h6>
                                <div class="header-elements">
                                    <span class="badge badge-success badge-pill">Approved</span>
                                </div>
                            </div>
                            <div class="card-body">
                                <p class="text-muted mb-1"><i class="icon-location3 mr-2"></i>{{ $restaurant->address ?? 'No address set.' }}</p>
                                <p class="text-muted mb-0"><i class="icon-phone2 mr-2"></i>{{ $restaurant->phone ?? 'No phone set.' }}</p>
                            </div>
                        </div>
                        @endif

                        <!-- Menu Items -->
                        <div class="card">
                            <div class="card-header header-elements-sm-inline">
                                <h6 class="card-title font-weight-bold">
                                    <i class="icon-list mr-2 text-primary"></i> My Menu Items
                                </h6>
                                <div class="header-elements">
                                    <a href="{{ route('menu.create') }}" class="btn btn-primary btn-sm rounded-pill">
                                        <i class="icon-plus2 mr-1"></i> Add Item
                                    </a>
                                </div>
                            </div>

                            <div class="card-body">
                                @if($menus->isEmpty())
                                    <div class="text-center py-5 text-muted">
                                        <i class="icon-list icon-3x d-block mb-3"></i>
                                        <p>No menu items yet. <a href="{{ route('menu.create') }}">Add your first item!</a></p>
                                    </div>
                                @else
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Item Name</th>
                                                    <th>Price</th>
                                                    <th>Availability</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($menus as $menu)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td class="font-weight-semibold">{{ $menu->item_name }}</td>
                                                    <td>Rp {{ number_format($menu->price, 0, ',', '.') }}</td>
                                                    <td>
                                                        @if($menu->availability)
                                                            <span class="badge badge-success">Available</span>
                                                        @else
                                                            <span class="badge badge-danger">Unavailable</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('menu.edit', $menu) }}" class="btn btn-sm btn-info rounded-pill mr-1">Edit</a>
                                                        <form action="{{ route('menu.destroy', $menu) }}" method="POST" class="d-inline"
                                                              onsubmit="return confirm('Delete this item?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-sm btn-danger rounded-pill">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="mt-3">
                                        {{ $menus->links() }}
                                    </div>
                                @endif
                            </div>
                        </div>

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