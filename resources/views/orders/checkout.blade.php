@extends('layouts.app')
@section('title', 'Checkout — BookStore')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-10">

    <h1 class="text-3xl font-bold text-gray-800 mb-8">Checkout</h1>

    <div class="grid md:grid-cols-3 gap-6">

        {{-- Form Pengiriman --}}
        <div class="md:col-span-2">
            <div class="bg-white rounded-xl shadow p-6">
                <h2 class="text-lg font-bold text-gray-800 mb-4">📍 Informasi Pengiriman</h2>
                <form action="/orders" method="POST" class="space-y-4" id="checkoutForm">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Alamat Pengiriman
                        </label>
                        <textarea name="shipping_address" rows="3" required
                                  class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm
                                         focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                  placeholder="Alamat lengkap pengiriman">{{ session('user')['address'] ?? '' }}</textarea>
                        @error('shipping_address')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            No. Telepon
                        </label>
                        <input type="text" name="phone" required
                               value="{{ session('user')['phone'] ?? '' }}"
                               class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm
                                      focus:outline-none focus:ring-2 focus:ring-indigo-500"
                               placeholder="08xxxxxxxxxx">
                        @error('phone')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Catatan (opsional)
                        </label>
                        <textarea name="notes" rows="2"
                                  class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm
                                         focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                  placeholder="Catatan tambahan untuk pesanan"></textarea>
                    </div>

                    {{-- Metode Pembayaran --}}
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                        <p class="text-sm font-semibold text-yellow-800">💵 Metode Pembayaran</p>
                        <p class="text-sm text-yellow-700 mt-1">
                            Cash on Delivery (COD) — Bayar saat buku tiba di tanganmu
                        </p>
                    </div>
            </div>
        </div>

        {{-- Order Summary --}}
        <div class="space-y-4">
            <div class="bg-white rounded-xl shadow p-6">
                <h2 class="text-lg font-bold text-gray-800 mb-4">📋 Ringkasan Pesanan</h2>
                <div class="space-y-3 mb-4">
                    @foreach($cartItems as $item)
                    <div class="flex gap-3 items-center">
                        <img src="{{ $item->book->image ? Storage::url($item->book->image) : 'https://images.unsplash.com/photo-1543002588-bfa74002ed7e?w=100' }}"
                             class="w-12 h-14 object-cover rounded">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-800 line-clamp-1">
                                {{ $item->book->title }}
                            </p>
                            <p class="text-xs text-gray-500">x{{ $item->quantity }}</p>
                        </div>
                        <p class="text-sm font-semibold text-gray-800">
                            Rp {{ number_format($item->book->price * $item->quantity, 0, ',', '.') }}
                        </p>
                    </div>
                    @endforeach
                </div>
                <hr class="mb-3">
                <div class="flex justify-between font-bold text-gray-800">
                    <span>Total</span>
                    <span class="text-indigo-600">Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>

                <button type="submit" form="checkoutForm"
                        class="w-full mt-4 bg-indigo-600 text-white font-semibold py-3
                               rounded-lg hover:bg-indigo-700 transition">
                    ✅ Buat Pesanan
                </button>
                    </form>
            </div>
        </div>
    </div>
</div>
@endsection