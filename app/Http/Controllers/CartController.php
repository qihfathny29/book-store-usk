<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Book;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /** Tampilkan isi cart milik user yang sedang login */
    public function index()
    {
        $userId    = session('user')['id'];
        $cartItems = CartItem::with('book')->where('user_id', $userId)->get();
        $total     = $cartItems->sum(fn($item) => $item->book->price * $item->quantity);

        return view('cart.index', compact('cartItems', 'total'));
    }

    /** Tambahkan buku ke cart */
    public function store(Request $request)
    {
        $request->validate([
            'book_id'  => 'required|exists:books,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $userId = session('user')['id'];
        $book   = Book::findOrFail($request->book_id);

        // Cek stok buku sebelum menambah
        $requestedQuantity = $request->quantity;
        
        // Cek apakah buku sudah ada di cart
        $cartItem = CartItem::where('user_id', $userId)
                            ->where('book_id', $request->book_id)
                            ->first();
                            
        // Hitung total quantity jika sudah ada di keranjang
        $totalQuantity = $cartItem ? ($cartItem->quantity + $requestedQuantity) : $requestedQuantity;
        
        if ($totalQuantity > $book->stock) {
            return back()->with('error', 'Gagal menambahkan! Stok buku "' . $book->title . '" hanya tersisa ' . $book->stock . '.');
        }

        if ($cartItem) {
            // Update quantity jika sudah ada
            $cartItem->increment('quantity', $request->quantity);
        } else {
            // Buat cart item baru
            CartItem::create([
                'user_id'  => $userId,
                'book_id'  => $request->book_id,
                'quantity' => $request->quantity,
            ]);
        }

        return back()->with('success', 'Buku berhasil ditambahkan ke keranjang!');
    }

    /** Update quantity item di cart */
    public function update(Request $request, $id)
    {
        $request->validate(['quantity' => 'required|integer|min:1']);

        $cartItem = CartItem::where('id', $id)
                            ->where('user_id', session('user')['id'])
                            ->firstOrFail();

        // Hindari set melebihi stok yang ada
        $book = Book::findOrFail($cartItem->book_id);
        if ($request->quantity > $book->stock) {
            return back()->with('error', 'Gagal membarui! Stok buku "' . $book->title . '" hanya tersisa ' . $book->stock . '.');
        }

        $cartItem->update(['quantity' => $request->quantity]);

        return back()->with('success', 'Keranjang berhasil diperbarui!');
    }

    /** Menghapus buku dari cart */
    public function destroy($id)
    {
        $userId = session('user')['id'];
        $cartItem = CartItem::where('id', $id)
                            ->where('user_id', $userId)
                            ->firstOrFail();
                            
        $cartItem->delete();

        return back()->with('success', 'Buku berhasil dihapus dari keranjang!');
    }
}