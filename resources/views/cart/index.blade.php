@extends('layouts.app')
@section('title', 'Keranjang — BookStore')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-10">

    <h1 class="text-3xl font-bold text-gray-800 mb-8">🛒 Keranjang Belanja</h1>

    @if($cartItems->count() > 0)
    <div class="grid md:grid-cols-3 gap-6">

        {{-- List Item --}}
        <div class="md:col-span-2 space-y-4">
            @foreach($cartItems as $item)
            <div class="bg-white rounded-xl shadow p-4 flex gap-4 items-start">

                <img src="{{ $item->book->image ? Storage::url($item->book->image) : 'https://images.unsplash.com/photo-1543002588-bfa74002ed7e?w=200' }}"
                     alt="{{ $item->book->title }}"
                     class="w-20 h-24 object-cover rounded-lg flex-shrink-0">

                <div class="flex-1">
                    <h3 class="font-semibold text-gray-800">{{ $item->book->title }}</h3>
                    <p class="text-sm text-gray-500">{{ $item->book->author }}</p>
                    <p class="text-indigo-600 font-bold mt-1">
                        Rp {{ number_format($item->book->price, 0, ',', '.') }}
                    </p>

                    {{-- Update Quantity --}}
                    <form action="/cart/{{ $item->id }}" method="POST" class="flex items-center gap-2 mt-2">
                        @csrf
                        @method('PATCH')
                        <input type="number" name="quantity" value="{{ $item->quantity }}"
                               min="1" max="{{ $item->book->stock }}"
                               class="w-16 border border-gray-300 rounded-lg px-2 py-1 text-sm
                                      focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <button type="submit"
                                class="text-xs bg-gray-100 text-gray-600 px-3 py-1 rounded-lg hover:bg-gray-200">
                            Update
                        </button>
                    </form>
                </div>

                <div class="text-right">
                    <p class="font-bold text-gray-800">
                        Rp {{ number_format($item->book->price * $item->quantity, 0, ',', '.') }}
                    </p>

                    {{-- Hapus --}}
                    <form action="/cart/{{ $item->id }}" method="POST" class="mt-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-xs text-red-500 hover:text-red-700">
                            🗑️ Hapus
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Summary --}}
        <div class="bg-white rounded-xl shadow p-6 h-fit">
            <h2 class="text-lg font-bold text-gray-800 mb-4">Ringkasan</h2>
            <div class="flex justify-between text-sm text-gray-600 mb-2">
                <span>Subtotal</span>
                <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between text-sm text-gray-600 mb-4">
                <span>Pengiriman</span>
                <span class="text-green-600 font-medium">COD</span>
            </div>
            <hr class="mb-4">
            <div class="flex justify-between font-bold text-gray-800 mb-6">
                <span>Total</span>
                <span class="text-indigo-600">Rp {{ number_format($total, 0, ',', '.') }}</span>
            </div>
            <a href="/checkout"
               class="block w-full bg-indigo-600 text-white text-center font-semibold
                      py-3 rounded-lg hover:bg-indigo-700 transition">
                Checkout Sekarang
            </a>
        </div>
    </div>

    @else
    <div class="text-center py-20">
        <p class="text-6xl mb-4">🛒</p>
        <p class="text-gray-500 text-lg mb-4">Keranjangmu masih kosong</p>
        <a href="/books"
           class="bg-indigo-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-indigo-700 transition">
            Mulai Belanja
        </a>
    </div>
    @endif

</div>
@endsection