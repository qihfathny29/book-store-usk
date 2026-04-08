<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan BookStore</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #333;
            line-height: 1.5;
            margin: 20px;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #dc2626;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            color: #111;
            font-size: 26px;
        }
        .header p {
            margin: 5px 0 0 0;
            color: #666;
            font-size: 14px;
        }
        .summary-box {
            background-color: #f8f9fa;
            border-left: 4px solid #dc2626;
            padding: 15px;
            margin-bottom: 30px;
        }
        .summary-box p {
            margin: 5px 0;
            font-size: 14px;
        }
        .summary-box p strong {
            display: inline-block;
            width: 150px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #111;
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .footer {
            margin-top: 40px;
            text-align: right;
            font-size: 12px;
            color: #666;
        }
        .badge {
            padding: 3px 6px;
            font-size: 10px;
            background-color: #eee;
            border-radius: 4px;
        }

        /* Hilangkan elemen aksi saat di print */
        @media print {
            .no-print {
                display: none !important;
            }
            body {
                margin: 0;
            }
        }
        
        .action-buttons {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px dashed #ccc;
        }

        .btn {
            background-color: #dc2626;
            color: #fff;
            padding: 8px 16px;
            text-decoration: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: bold;
            border: none;
            cursor: pointer;
        }
        .btn-secondary {
            background-color: #333;
        }
        .btn:hover { opacity: 0.9; }
    </style>
</head>
<body>

    <div class="action-buttons no-print">
        <a href="/admin/dashboard" class="btn btn-secondary">Kembali ke Dashboard</a>
        <button onclick="window.print()" class="btn">Cetak Laporan (PDF)</button>
    </div>

    <div class="header">
        <h1>BookStore - Laporan Penjualan</h1>
        <p>Tanggal Cetak: {{ \Carbon\Carbon::now()->format('d M Y H:i') }}</p>
    </div>

    <div class="summary-box">
        <p><strong>Total Pendapatan</strong>: Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
        <p><strong>Buku Terjual</strong>: {{ $totalBooksSold }} Unit</p>
        <p><strong>Jumlah Transaksi</strong>: {{ $orders->count() }} Pesanan (Berhasil)</p>
    </div>

    <h3>Rincian Transaksi Sukses</h3>
    <table>
        <thead>
            <tr>
                <th width="10%">Order ID</th>
                <th width="15%">Tanggal</th>
                <th width="20%">Pelanggan</th>
                <th width="35%">Item</th>
                <th width="20%" class="text-right">Total Transaksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
                <tr>
                    <td class="text-center">#{{ $order->id }}</td>
                    <td>{{ $order->created_at->format('d/m/Y') }}</td>
                    <td>{{ $order->user->name }}</td>
                    <td>
                        <ul style="margin: 0; padding-left: 15px;">
                            @foreach($order->orderItems as $item)
                                <li>{{ $item->book->title }} (x{{ $item->quantity }})</li>
                            @endforeach
                        </ul>
                    </td>
                    <td class="text-right font-bold">
                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Belum ada transaksi penjualan yang sukses.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Dokumen ini di-generate secara otomatis oleh Sistem BookStore.</p>
    </div>

    <!-- Otomatis buka dialog print saat halaman dimuat -->
    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html>