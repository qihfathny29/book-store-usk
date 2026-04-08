<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use App\Models\Order;
use App\Models\User;
use App\Models\Message;

class DashboardController extends Controller
{
    /** Tampilkan halaman dashboard admin dengan statistik */
    public function index()
    {
        $stats = [
            'total_books'      => Book::count(),
            'total_categories' => Category::count(),
            'total_users'      => User::where('role', 'user')->count(),
            'total_orders'     => Order::count(),
            'pending_orders'   => Order::where('status', 'pending')->count(),
            'unread_messages'  => Message::where('is_read', false)->count(),
            'total_revenue'    => Order::whereIn('status', ['delivered', 'completed'])->sum('total_price'),
            'books_sold'       => \App\Models\OrderItem::whereHas('order', function($q) {
                                    $q->whereIn('status', ['delivered', 'completed']);
                                 })->sum('quantity'),
        ];

        $recentOrders   = Order::with('user')->latest()->take(5)->get();
        $recentMessages = Message::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentOrders', 'recentMessages'));
    }

    /** Download Laporan Penjualan via PDF */
    public function printPDF()
    {
        $orders = Order::with('user', 'orderItems.book')
            ->whereIn('status', ['delivered', 'completed'])
            ->latest()
            ->get();

        $totalRevenue = $orders->sum('total_price');
        $totalBooksSold = $orders->sum(function ($order) {
            return $order->orderItems->sum('quantity');
        });

        return view('admin.report.pdf', compact('orders', 'totalRevenue', 'totalBooksSold'));
    }

    /** Download Laporan Penjualan via Excel (CSV) tanpa Library */
    public function exportExcel()
    {
        // 1. Ambil data transaksi yang sudah sukses
        $orders = Order::with('user', 'orderItems.book')
            ->whereIn('status', ['delivered', 'completed'])
            ->latest()
            ->get();

        $filename = "Laporan_Penjualan_BookStore_" . date('Y-m-d') . ".csv";

        // 2. Siapkan file stream dan header HTTP agar browser mendownloadnya
        return response()->streamDownload(function () use ($orders) {
            $file = fopen('php://output', 'w');
            
            // Tulis Header Kolom Excel (Baris pertama)
            fputcsv($file, ['Order ID', 'Tanggal Transaksi', 'Nama Pelanggan', 'Detail Item Buku', 'Total Harga (Rp)']);

            // Looping data order dan masukkan ke tiap baris
            foreach ($orders as $order) {
                // Menggabungkan judul buku biar rapi di satu cell, misal: "Ayat-Ayat Cinta (x2), Laskar Pelangi (x1)"
                $itemDetails = [];
                foreach ($order->orderItems as $item) {
                    $itemDetails[] = $item->book->title . " (x" . $item->quantity . ")";
                }

                fputcsv($file, [
                    '#' . $order->id,
                    $order->created_at->format('d/m/Y H:i'),
                    $order->user->name,
                    implode(', ', $itemDetails),
                    $order->total_price
                ]);
            }
            fclose($file);
        }, $filename, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }
}