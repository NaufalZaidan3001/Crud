<table>
    <thead>
        <tr>
            <th colspan="5" style="font-size: 16px; font-weight: bold;">Order #{{ $order->id }} - {{ strtoupper($order->status) }}</th>
        </tr>
        <tr>
            <th>Customer:</th>
            <th>{{ $order->user->name ?? 'Unknown' }} ({{ $order->user->email ?? '' }})</th>
        </tr>
        <tr>
            <th>Restaurant:</th>
            <th>{{ $order->restaurant->restaurant_name ?? 'Unknown' }}</th>
        </tr>
        <tr>
            <th colspan="5"></th>
        </tr>
        <tr>
            <th>Item Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @php $items = json_decode($order->items, true) ?? []; @endphp
        @foreach($items as $item)
        <tr>
            <td>{{ $item['name'] ?? 'Unknown Item' }}</td>
            <td>{{ $item['price'] ?? 0 }}</td>
            <td>{{ $item['quantity'] ?? 1 }}</td>
            <td>{{ ($item['price'] ?? 0) * ($item['quantity'] ?? 1) }}</td>
            <td>{{ ucfirst($order->status) }}</td>
        </tr>
        @endforeach
        <tr>
            <td colspan="3" align="right"><strong>Grand Total:</strong></td>
            <td><strong>{{ $order->total_price }}</strong></td>
            <td></td>
        </tr>
    </tbody>
</table>
