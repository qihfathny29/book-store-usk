<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /** Tampilkan halaman checkout */
    public function checkout()
    {
        $userId    = session('user')['id'];
        $cartItems = CartItem::with('book')->where('user_id', $userId)->get();

        // Redirect ke cart jika kosong
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang masih kosong!');
        }

        $total = $cartItems->sum(fn($item) => $item->book->price * $item->quantity);

        return view('orders.checkout', compact('cartItems', 'total'));
    }

    /** Proses pembuatan order baru dari cart */
    public function store(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|string',
            'phone'            => 'required|string|max:20',
            'notes'            => 'nullable|string',
        ]);

        $userId    = session('user')['id'];
        $cartItems = CartItem::with('book')->where('user_id', $userId)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang masih kosong!');
        }

        // Hitung total harga
        $total = $cartItems->sum(fn($item) => $item->book->price * $item->quantity);

        // Buat order baru
        $order = Order::create([
            'user_id'          => $userId,
            'total_price'      => $total,
            'status'           => 'pending',
            'shipping_address' => $request->shipping_address,
            'phone'            => $request->phone,
            'notes'            => $request->notes,
        ]);

        // Pindahkan cart items ke order items
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'book_id'  => $item->book_id,
                'quantity' => $item->quantity,
                'price'    => $item->book->price,
            ]);
        }

        // Kosongkan cart setelah order dibuat
        CartItem::where('user_id', $userId)->delete();

        return redirect()->route('orders.show', $order->id)
                         ->with('success', 'Pesanan berhasil dibuat! Pembayaran dilakukan saat buku tiba.');
    }

    /** Tampilkan riwayat order user */
    public function index()
    {
        $userId = session('user')['id'];
        $orders = Order::where('user_id', $userId)->latest()->paginate(10);

        return view('orders.index', compact('orders'));
    }

    /** Tampilkan detail satu order */
    public function show($id)
    {
        $userId = session('user')['id'];
        $order  = Order::with('orderItems.book')
                       ->where('user_id', $userId)
                       ->findOrFail($id);

        return view('orders.show', compact('order'));
    }
}