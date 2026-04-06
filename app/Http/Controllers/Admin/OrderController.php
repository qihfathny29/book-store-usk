<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /** Tampilkan semua order dari semua user */
    public function index()
    {
        $orders = Order::with('user')->latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    /** Tampilkan detail satu order */
    public function show($id)
    {
        $order = Order::with('user', 'orderItems.book')->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    /** Update status order */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,completed'
        ]);

        Order::findOrFail($id)->update(['status' => $request->status]);

        return back()->with('success', 'Status pesanan berhasil diperbarui!');
    }
}