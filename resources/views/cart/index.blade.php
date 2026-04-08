@extends('layouts.user')

@section('title', 'Keranjang Belanja - BookStore')

@section('content')
<div class="mb-8">
    <h2 class="text-3xl font-bold text-white mb-2">Keranjang Belanja</h2>
    <p class="text-gray-400">Kelola buku-buku yang ingin Anda beli.</p>
</div>

@if(count($cartItems) > 0)
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Cart Items --}}
        <div class="lg:col-span-2 space-y-4">
            @foreach($cartItems as $item)
                <div class="bg-black border border-red-900/50 rounded-2xl p-4 flex gap-6 relative group hover:border-red-500/50 transition-colors">
                    {{-- Book Image --}}
                    <div class="w-24 h-32 rounded-lg bg-zinc-900 border border-zinc-800 flex-shrink-0 overflow-hidden">
                        @if($item->book->image)
                            <img src="{{ Storage::url($item->book->image) }}" alt="{{ $item->book->title }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-zinc-700">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                        @endif
                    </div>

                    {{-- Book Details --}}
                    <div class="flex-1 flex flex-col pt-1">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-lg font-bold text-white leading-tight mb-1">{{ $item->book->title }}</h3>
                                <p class="text-sm text-gray-400 mb-2">{{ $item->book->author }}</p>
                            </div>
                            <form action="/cart/{{ $item->id }}" method="POST" onsubmit="return confirm('Hapus item ini dari keranjang?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-400 p-2 rounded-xl hover:bg-red-500/10 transition-colors" title="Hapus Item">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </div>

                        <div class="mt-auto flex items-center justify-between">
                            <span class="text-lg font-bold text-white">Rp {{ number_format($item->book->price, 0, ',', '.') }}</span>
                            
                            {{-- Quantity Update --}}
                            <form action="/cart/{{ $item->id }}" method="POST" class="flex items-center gap-3">
                                @csrf
                                @method('PUT')
                                <div class="flex items-center bg-zinc-900 border border-zinc-800 rounded-lg p-1">
                                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->book->stock }}" class="w-16 bg-transparent text-center text-white text-sm focus:outline-none border-none hide-arrows" onchange="this.form.submit()">
                                </div>
                                <span class="text-xs text-gray-500">Stok: {{ $item->book->stock }}</span>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Order Summary --}}
        <div class="lg:col-span-1">
            <div class="bg-black border border-red-900 rounded-2xl p-6 sticky top-6">
                <h3 class="text-lg font-bold text-white mb-6">Ringkasan Pesanan</h3>
                
                <div class="space-y-4 mb-6">
                    <div class="flex justify-between text-gray-400">
                        <span>Total Item</span>
                        <span>{{ $cartItems->sum('quantity') }}</span>
                    </div>
                    <div class="flex justify-between text-gray-400">
                        <span>Subtotal</span>
                        <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="border-t border-red-900/50 pt-4 mb-8">
                    <div class="flex justify-between items-center">
                        <span class="font-bold text-white">Total</span>
                        <span class="text-2xl font-bold text-red-500">
                            Rp {{ number_format($total, 0, ',', '.') }}
                        </span>
                    </div>
                </div>

                <a href="/checkout" class="w-full flex items-center justify-center gap-2 bg-red-600 hover:bg-red-700 text-white px-6 py-4 rounded-xl font-bold transition-all shadow-lg shadow-red-500/20">
                    Lanjut ke Pembayaran
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
            </div>
        </div>
    </div>
@else
    {{-- Empty State --}}
    <div class="bg-black border border-red-900/50 rounded-2xl p-12 text-center">
        <div class="w-24 h-24 bg-red-900/20 rounded-full flex items-center justify-center mx-auto mb-6">
            <svg class="w-12 h-12 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-10H5.4M7 13L5.4 5M7 13l-1.5 6h11"></path></svg>
        </div>
        <h3 class="text-xl font-bold text-white mb-2">Keranjang Belanja Kosong</h3>
        <p class="text-gray-400 mb-8 max-w-md mx-auto">Anda belum menambahkan buku apapun ke dalam keranjang. Silakan jelajahi katalog kami.</p>
        <a href="/user/books" class="inline-flex items-center gap-2 bg-zinc-900 hover:bg-black border border-zinc-700 hover:border-red-500 text-white px-6 py-3 rounded-xl font-medium transition-all">
            Mulai Belanja
            <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
        </a>
    </div>
@endif

<style>
/* Hide up/down arrows in number input */
.hide-arrows::-webkit-outer-spin-button,
.hide-arrows::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
.hide-arrows {
    -moz-appearance: textfield;
}
</style>
@endsection
