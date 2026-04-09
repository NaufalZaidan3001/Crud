<!DOCTYPE html>
<html lang="en">

<x-layout.head title="Order #{{ $order->id }}" />

<body>
    <x-layout.navbar />
    <div class="page-content">
        <x-layout.sidebar-panel />
        <div class="content-wrapper">
            <x-layout.page-header title="Order Details" :breadcrumbs="['Orders', 'Order #' . $order->id]" />
            <div class="content">
                <div class="card">
                    <div class="card-header bg-white header-elements-sm-inline">
                        <h6 class="card-title font-weight-bold">
                            <i class="icon-file-text2 mr-2 text-primary"></i> Order #{{ $order->id }}
                        </h6>
                        <div class="header-elements">
                            <span class="badge badge-{{ $order->status === 'completed' ? 'success' : ($order->status === 'pending' ? 'warning' : 'danger') }} badge-pill p-2">
                                {{ strtoupper($order->status) }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-sm-6">
                                <h6 class="font-weight-bold">Restaurant Information</h6>
                                <p class="mb-1">{{ $order->restaurant->restaurant_name ?? 'Unknown' }}</p>
                            </div>
                            <div class="col-sm-6 text-sm-right">
                                <h6 class="font-weight-bold">Customer Information</h6>
                                <p class="mb-1">{{ $order->user->name ?? 'Unknown' }}</p>
                                <p class="mb-1 text-muted">{{ $order->user->email ?? '' }}</p>
                            </div>
                        </div>

                        <div class="table-responsive border rounded mb-4">
                            <table class="table">
                                <thead class="bg-light">
                                    <tr>
                                        <th style="width: 50px;">Item</th>
                                        <th>Name</th>
                                        <th class="text-right">Price</th>
                                        <th class="text-center">Qty</th>
                                        <th class="text-right">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $items = json_decode($order->items, true) ?? [];
                                    @endphp
                                    
                                    @forelse($items as $item)
                                    <tr>
                                        <td>
                                            @if(isset($item['image']) && $item['image'])
                                                <img src="{{ asset('storage/' . $item['image']) }}" width="40" height="40" class="rounded" alt="" style="object-fit: cover;">
                                            @else
                                                <div class="bg-light rounded d-flex align-items-center justify-content-center text-muted" style="width: 40px; height: 40px;"><i class="icon-image2"></i></div>
                                            @endif
                                        </td>
                                        <td class="font-weight-semibold">{{ $item['name'] ?? 'Unknown Item' }}</td>
                                        <td class="text-right">Rp {{ number_format($item['price'] ?? 0, 0, ',', '.') }}</td>
                                        <td class="text-center">{{ $item['quantity'] ?? 1 }}</td>
                                        <td class="text-right font-weight-bold">Rp {{ number_format(($item['price'] ?? 0) * ($item['quantity'] ?? 1), 0, ',', '.') }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-3">No items found in this order.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-end">
                            <div class="text-right">
                                <h5 class="font-weight-bold mb-0">Total: Rp {{ number_format($order->total_price, 0, ',', '.') }}</h5>
                            </div>
                        </div>

                    </div>
                    
                    <div class="card-footer bg-white d-flex justify-content-between align-items-center">
                        <a href="{{ route('order.index') }}" class="btn btn-light rounded-pill">
                            <i class="icon-arrow-left52 mr-1"></i> Back to Orders
                        </a>
                        
                        @if(Auth::user()->role === 'restaurant' && Auth::user()->restaurant?->id === $order->restaurant_id)
                            @if($order->status === 'pending')
                                <div>
                                    <!-- Add forms for restaurant to Accept/Reject order here in the future -->
                                    <button class="btn btn-success rounded-pill font-weight-bold text-white mr-2">Accept Order</button>
                                    <button class="btn btn-danger rounded-pill font-weight-bold text-white">Reject Order</button>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
            <x-layout.footer />
        </div>
    </div>
</body>

</html>
