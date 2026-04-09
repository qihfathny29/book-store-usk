@extends('layouts.user')

@section('title', 'Checkout - BookStore')

@section('content')
<div class="mb-8">
    <a href="/cart" class="inline-flex items-center gap-2 text-gray-400 hover:text-white transition-colors mb-4">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Kembali ke Keranjang
    </a>
    <h2 class="text-3xl font-bold text-white mb-2">Checkout</h2>
    <p class="text-gray-400">Selesaikan pesanan Anda dengan mengisi detail pengiriman.</p>
</div>

<form action="/orders" method="POST">
    @csrf
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Detail Pengiriman --}}
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-black border border-red-900 rounded-2xl p-6">
                <h3 class="text-xl font-bold text-white mb-6 flex items-center gap-2">
                    <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    Detail Pengiriman
                </h3>

                <div class="space-y-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-2">Alamat Lengkap</label>
                        <textarea name="shipping_address" rows="3" class="w-full bg-zinc-900 border border-zinc-800 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 transition-colors resize-none" required placeholder="Contoh: Jl. Sudirman No. 123, RT 01/RW 02, Kel. Menteng...">{{ old('shipping_address', session('user')['address'] ?? '') }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-2">No. Telepon</label>
                            <input type="text" name="phone" value="{{ old('phone', session('user')['phone'] ?? '') }}" class="w-full bg-zinc-900 border border-zinc-800 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 transition-colors" required placeholder="Contoh: 081234567890">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-2">Catatan Pesanan (Opsional)</label>
                            <input type="text" name="notes" value="{{ old('notes') }}" class="w-full bg-zinc-900 border border-zinc-800 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 transition-colors" placeholder="Cth: Taruh di rak sepatu">
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-black border border-red-900 rounded-2xl p-6">
                <h3 class="text-xl font-bold text-white mb-6 flex items-center gap-2">
                    <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                    Metode Pembayaran
                </h3>

                <div class="space-y-4">
                    <label class="flex items-center p-4 border border-zinc-800 rounded-xl cursor-pointer hover:border-red-500 transition-colors bg-zinc-900 relative">
                        <input type="radio" name="payment_method" value="cod" checked class="w-5 h-5 text-red-600 bg-black border-red-900 focus:ring-red-600 focus:ring-offset-black" required>
                        <div class="ml-4 flex-1">
                            <span class="block text-white font-medium">Bayar di Tempat (COD)</span>
                            <span class="block text-sm text-gray-400">Bayar dengan uang tunai saat pesanan tiba di alamat Anda</span>
                        </div>
                        <svg class="w-8 h-8 text-gray-500 absolute right-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </label>
                </div>
            </div>
        </div>

        {{-- Order Summary --}}
        <div class="lg:col-span-1">
            <div class="bg-black border border-red-900 rounded-2xl p-6 sticky top-6">
                <h3 class="text-lg font-bold text-white mb-6">Ringkasan Pesanan</h3>
                
                <div class="space-y-4 mb-6 max-h-64 overflow-y-auto pr-2 custom-scrollbar">
                    @foreach($cartItems as $item)
                        <div class="flex gap-4">
                            <div class="w-16 h-20 bg-zinc-900 rounded border border-zinc-800 flex-shrink-0 overflow-hidden">
                                @if($item->book->image)
                                    <img src="{{ Storage::url($item->book->image) }}" class="w-full h-full object-cover">
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="text-sm font-bold text-white truncate">{{ $item->book->title }}</h4>
                                <p class="text-xs text-gray-400 mb-1">{{ $item->quantity }} x Rp {{ number_format($item->book->price, 0, ',', '.') }}</p>
                                <p class="text-sm font-medium text-red-500">Rp {{ number_format($item->book->price * $item->quantity, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="border-t border-red-900/50 pt-4 space-y-3 mb-6">
                    <div class="flex justify-between text-gray-400">
                        <span>Subtotal ({{ $cartItems->sum('quantity') }} item)</span>
                        <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-gray-400">
                        <span>Biaya Pengiriman</span>
                          <span>Rp {{ number_format($shipping_cost, 0, ',', '.') }}</span>
                      </div>
                  </div>

                  <div class="border-t border-red-900/50 pt-4 mb-8">
                      <div class="flex justify-between items-center">
                          <span class="font-bold text-white">Total Pembayaran</span>
                          <span class="text-2xl font-bold text-red-500">
                              Rp {{ number_format($total + $shipping_cost, 0, ',', '.') }}
                </div>

                <button type="submit" class="w-full flex items-center justify-center gap-2 bg-red-600 hover:bg-red-700 text-white px-6 py-4 rounded-xl font-bold transition-all shadow-lg shadow-red-500/20">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Buat Pesanan
                </button>
            </div>
        </div>
    </div>
</form>

<style>
.custom-scrollbar::-webkit-scrollbar {
    width: 4px;
}
.custom-scrollbar::-webkit-scrollbar-track {
    background: #18181b; 
    border-radius: 4px;
}
.custom-scrollbar::-webkit-scrollbar-thumb {
    background: #3f3f46; 
    border-radius: 4px;
}
.custom-scrollbar::-webkit-scrollbar-thumb:hover {
    background: #52525b; 
}
</style>
@endsection
