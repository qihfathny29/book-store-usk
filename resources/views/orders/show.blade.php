@extends('layouts.app')
@section('title', 'Detail Pesanan — BookStore')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-10">

    <div class="flex items-center gap-4 mb-8">
        <a href="/orders" class="text-indigo-600 hover:underline text-sm">← Kembali</a>
        <h1 class="text-2xl font-bold text-gray-800">Detail Pesanan #{{ $order->id }}</h1>
    </div>

    {{-- Status --}}
    @php
        $statusColor = [
            'pending'    => 'bg-yellow-100 text-yellow-700 border-yellow-200',
            'processing' => 'bg-blue-100 text-blue-700 border-blue-200',
            'shipped'    => 'bg-purple-100 text-purple-700 border-purple-200',
            'delivered'  => 'bg-green-100 text-green-700 border-green-200',
            'completed'  => 'bg-gray-100 text-gray-700 border-gray-200',
        ][$order->status] ?? 'bg-gray-100 text-gray-700';

        $statusLabel = [
            'pending'    => 'Menunggu Konfirmasi',
            'processing' => 'Sedang Diproses',
            'shipped'    => 'Sedang Dikirim',
            'delivered'  => 'Sudah Diterima',
            'completed'  => 'Selesai',
        ][$order->status] ?? $order->status;
    @endphp

    <div class="border rounded-xl p-4 mb-6 {{ $statusColor }}">
        <p class="font-semibold">Status: {{ $statusLabel }}</p>
        @if($order->status === 'shipped')
            <p class="text-sm mt-1">Siapkan uang ya, buku segera tiba!</p>
        @endif
    </div>

    {{-- Info Pengiriman --}}
    <div class="bg-white rounded-xl shadow p-6 mb-6">
        <h2 class="font-bold text-gray-800 mb-3">Info Pengiriman</h2>
        <p class="text-sm text-gray-600">
            <span class="font-medium">Alamat:</span> {{ $order->shipping_address }}
        </p>
        <p class="text-sm text-gray-600 mt-1">
            <span class="font-medium">Telepon:</span> {{ $order->phone }}
        </p>
        @if($order->notes)
        <p class="text-sm text-gray-600 mt-1">
            <span class="font-medium">Catatan:</span> {{ $order->notes }}
        </p>
        @endif
        <p class="text-sm text-gray-600 mt-1">
            <span class="font-medium">Pembayaran:</span>
            <span class="text-yellow-600 font-medium">Cash on Delivery (COD)</span>
        </p>
    </div>

    {{-- Daftar Buku --}}
    <div class="bg-white rounded-xl shadow p-6 mb-6">
        <h2 class="font-bold text-gray-800 mb-4">Buku Dipesan</h2>
        <div class="space-y-4">
            @foreach($order->orderItems as $item)
            <div class="flex gap-4 items-center">
                <img src="{{ $item->book->image ? Storage::url($item->book->image) : 'https://images.unsplash.com/photo-1543002588-bfa74002ed7e?w=100' }}"
                     class="w-16 h-20 object-cover rounded-lg">
                <div class="flex-1">
                    <p class="font-medium text-gray-800">{{ $item->book->title }}</p>
                    <p class="text-sm text-gray-500">{{ $item->book->author }}</p>
                    <p class="text-sm text-gray-600 mt-1">
                        Rp {{ number_format($item->price, 0, ',', '.') }} x {{ $item->quantity }}
                    </p>
                </div>
                <p class="font-bold text-indigo-600">
                    Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                </p>
            </div>
            @endforeach
        </div>
        <hr class="my-4">
        <div class="flex justify-between font-bold text-gray-800">
            <span>Total Pembayaran</span>
            <span class="text-indigo-600 text-lg">
                Rp {{ number_format($order->total_price, 0, ',', '.') }}
            </span>
        </div>
    </div>

</div>
@endsection