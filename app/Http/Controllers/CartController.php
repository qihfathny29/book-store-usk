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

        // Cek apakah buku sudah ada di cart
        $cartItem = CartItem::where('user_id', $userId)
                            ->where('book_id', $request->book_id)
                            ->first();

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

        $cartItem->update(['quantity' => $request->quantity]);

        return back()->with('success', 'Keranjang berhasil diperbarui!');
    }

    /** Hapus item dari cart */
    public function destroy($id)
    {
        CartItem::where('id', $id)
                ->where('user_id', session('user')['id'])
                ->firstOrFail()
                ->delete();

        return back()->with('success', 'Buku berhasil dihapus dari keranjang!');
    }
}