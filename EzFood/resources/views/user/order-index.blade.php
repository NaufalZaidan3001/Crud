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
                        @if($orders->isEmpty())
                        <div class="text-center py-5 text-muted">
                            <i class="icon-list icon-3x d-block mb-3"></i>
                            <p>No orders found.</p>
                        </div>
                        @else
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Order ID</th>
                                        <th>Restaurant</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="font-weight-semibold">#{{ $order->id }}</td>
                                        <td>{{ $order->restaurant->restaurant_name ?? 'Unknown' }}</td>
                                        <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                        <td>
                                            <span class="badge badge-{{ $order->status === 'completed' ? 'success' : ($order->status === 'pending' ? 'warning' : 'danger') }}">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('order.show', $order) }}" class="btn btn-sm btn-primary rounded-pill">View Details</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3">{{ $orders->links() }}</div>
                        @endif
                    </div>
                </div>
            </div>
            <x-layout.footer />
        </div>
    </div>
</body>

</html>