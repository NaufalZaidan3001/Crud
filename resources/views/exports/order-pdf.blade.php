<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order #{{ $order->id }} Invoice</title>
    <style>
        body { font-family: sans-serif; font-size: 14px; margin: 0; padding: 20px; }
        .header { text-align: center; margin-bottom: 30px; }
        .header h1 { margin: 0; font-size: 24px; color: #333; }
        .details { width: 100%; margin-bottom: 30px; }
        .details td { vertical-align: top; width: 50%; }
        .details h4 { margin: 0 0 5px 0; color: #555; }
        table.items { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        table.items th, table.items td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        table.items th { background-color: #f8f9fa; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .total { font-size: 18px; font-weight: bold; text-align: right; margin-top: 20px; }
        .status { padding: 5px 10px; background-color: #28a745; color: #fff; border-radius: 4px; display: inline-block; font-size: 12px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>INVOICE</h1>
        <p>Order #{{ $order->id }}</p>
        <span class="status">{{ strtoupper($order->status) }}</span>
    </div>

    <table class="details">
        <tr>
            <td>
                <h4>RESTAURANT</h4>
                <p>
                    <strong>{{ $order->restaurant->restaurant_name ?? 'Unknown' }}</strong><br>
                    {{ $order->restaurant->address ?? '' }}<br>
                    {{ $order->restaurant->phone ?? '' }}
                </p>
            </td>
            <td class="text-right">
                <h4>CUSTOMER</h4>
                <p>
                    <strong>{{ $order->user->name ?? 'Unknown' }}</strong><br>
                    {{ $order->user->email ?? '' }}<br>
                    {{ $order->user->phone ?? '' }}
                </p>
            </td>
        </tr>
    </table>

    <table class="items">
        <thead>
            <tr>
                <th>No</th>
                <th>Item Name</th>
                <th class="text-right">Price</th>
                <th class="text-center">Qty</th>
                <th class="text-right">Total</th>
            </tr>
        </thead>
        <tbody>
            @php $items = json_decode($order->items, true) ?? []; @endphp
            @foreach($items as $index => $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item['name'] ?? 'Unknown Item' }}</td>
                <td class="text-right">Rp {{ number_format($item['price'] ?? 0, 0, ',', '.') }}</td>
                <td class="text-center">{{ $item['quantity'] ?? 1 }}</td>
                <td class="text-right">Rp {{ number_format(($item['price'] ?? 0) * ($item['quantity'] ?? 1), 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total">
        Grand Total: Rp {{ number_format($order->total_price, 0, ',', '.') }}
    </div>
</body>
</html>
