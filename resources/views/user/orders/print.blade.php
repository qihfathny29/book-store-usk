<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pesanan #{{ $order->id }} - BookStore</title>
    @vite(['resources/css/app.css'])
    <style>
        body {
            background-color: #fff;
            color: #000;
            font-family: 'Courier New', Courier, monospace;
            padding: 20px;
        }
        .receipt-container {
            max-width: 400px;
            margin: 0 auto;
            border: 1px dashed #000;
            padding: 20px;
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .font-bold { font-weight: bold; }
        .mb-2 { margin-bottom: 0.5rem; }
        .mb-4 { margin-bottom: 1rem; }
        .mt-4 { margin-top: 1rem; }
        .w-full { width: 100%; }
        .border-b { border-bottom: 1px dashed #000; }
        .border-t { border-top: 1px dashed #000; }
        .pb-2 { padding-bottom: 0.5rem; }
        .pt-2 { padding-top: 0.5rem; }
        .text-sm { font-size: 0.875rem; }
        .flex { display: flex; }
        .justify-between { justify-content: space-between; }
        table { width: 100%; }
        th, td { padding: 4px 0; vertical-align: top; }
        @media print {
            body { padding: 0; }
            .receipt-container { border: none; margin: 0; max-width: 100%; }
            .no-print { display: none; }
        }
    </style>
</head>
<body onload="window.print()">
    <div class="receipt-container">
        <div class="text-center mb-4">
            <h2 class="font-bold">BOOKSTORE</h2>
            <p class="text-sm">Gudang Pengetahuan</p>
            <p class="text-sm">Jalan Ilmu No. 1, Jakarta</p>
        </div>

        <div class="border-b pb-2 mb-2 text-sm">
            <div class="flex justify-between">
                <span>No. Pesanan:</span>
                <span>#{{ $order->id }}</span>
            </div>
            <div class="flex justify-between">
                <span>Tanggal:</span>
                <span>{{ $order->created_at->format('d/m/Y H:i') }}</span>
            </div>
            <div class="flex justify-between">
                <span>Pelanggan:</span>
                <span>{{ $order->user->name ?? 'Guest' }}</span>
            </div>
            <div class="flex justify-between">
                <span>Pembayaran:</span>
                <span>COD</span>
            </div>
        </div>

        <div class="mb-4">
            <p class="font-bold text-sm mb-1">Pengiriman Ke:</p>
            <p class="text-sm">{{ $order->shipping_address }}</p>
            <p class="text-sm">Telp: {{ $order->phone }}</p>
        </div>

        <table class="text-sm mb-4 border-b pb-2">
            <thead>
                <tr class="border-b">
                    <th style="text-align: left;">Item</th>
                    <th style="text-align: center;">Qty</th>
                    <th style="text-align: right;">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->orderItems as $item)
                <tr>
                    <td style="padding-right: 5px;">{{ $item->book->title }}<br><small>Rp {{ number_format($item->price, 0, ',', '.') }}</small></td>
                    <td style="text-align: center;">{{ $item->quantity }}</td>
                    <td style="text-align: right;">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="flex justify-between text-sm" style="margin-top: 10px;">
            <span>Subtotal:</span>
            <span>Rp {{ number_format($order->total_price - $order->shipping_cost, 0, ',', '.') }}</span>
        </div>
        <div class="flex justify-between text-sm">
            <span>Ongkos Kirim:</span>
            <span>Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
        </div>
        <div class="flex justify-between font-bold text-sm" style="margin-top: 5px; padding-top: 5px; border-top: 1px dashed #000;">
            <span>Total Bayar:</span>
            <span>Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
        </div>

        <div class="text-center mt-4 pt-4 border-t text-sm">
            <p>Terima kasih atas belanja Anda!</p>
            <p>Barang yang sudah dibeli tidak dapat ditukar.</p>
        </div>
        
        <div class="text-center mt-4 no-print">
            <button onclick="window.print()" style="padding: 5px 15px; cursor: pointer; border: 1px solid #000; background: #fff;">Print / Simpan PDF</button>
        </div>
    </div>
</body>
</html>