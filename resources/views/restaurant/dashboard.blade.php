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
                                <div class="table-responsive">
                                    <table class="table table-hover" id="menus-table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Item Name</th>
                                                <th>Price</th>
                                                <th>Availability</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
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
    <script src="{{ asset('global_assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#menus-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('restaurant.dashboard') }}",
                columns: [
                    { data: 'id', name: 'id', orderable: false, searchable: false, render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }},
                    { data: 'item_name', name: 'item_name' },
                    { data: 'price_formatted', name: 'price', orderable: false, searchable: false },
                    { data: 'availability_badge', name: 'availability', orderable: false, searchable: false },
                    { data: 'actions', name: 'actions', orderable: false, searchable: false }
                ],
                order: [[1, 'asc']],
                dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
                language: {
                    search: '<span>Filter:</span> _INPUT_',
                    searchPlaceholder: 'Search Menu...',
                    lengthMenu: '<span>Show:</span> _MENU_',
                    paginate: { 'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;' }
                }
            });
        });
    </script>
</body>
</html>