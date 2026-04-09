<!DOCTYPE html>
<html lang="en">

<x-layout.head title="Order List" />

<body>
    <x-layout.navbar />
    <div class="page-content">
        <x-layout.sidebar-panel />
        <div class="content-wrapper">
            <x-layout.page-header title="Order List" :breadcrumbs="['Order List']" />
            <div class="content">
                <div class="card">
                    <div class="card-header header-elements-sm-inline">
                        <h6 class="card-title font-weight-bold">
                            <i class="icon-list mr-2 text-primary"></i> Order List
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover" id="orders-table">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Restaurant</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <x-layout.footer />
        </div>
    </div>
    
    <script src="{{ asset('global_assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#orders-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('order.index') }}',
                columns: [
                    { data: 'id', name: 'id', render: function(data) { return '#' + data; } },
                    { data: 'restaurant_name', name: 'restaurant_name', orderable: false },
                    { data: 'total_formatted', name: 'total_price', orderable: false, searchable: false },
                    { data: 'status_badge', name: 'status', orderable: false, searchable: false },
                    { data: 'actions', name: 'actions', orderable: false, searchable: false }
                ],
                order: [[0, 'desc']],
                dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
                language: {
                    search: '<span>Filter:</span> _INPUT_',
                    searchPlaceholder: 'Search Order ID...',
                    lengthMenu: '<span>Show:</span> _MENU_',
                    paginate: { 'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;' }
                }
            });
        });
    </script>
</body>
</html>