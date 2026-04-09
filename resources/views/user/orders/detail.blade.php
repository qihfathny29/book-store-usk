@extends('layouts.user')
@section('title', 'Detail Pesanan — BookStore')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-10">

    <div class="flex items-center justify-between mb-8">
        <div class="flex items-center gap-4">
            <a href="/orders" class="text-red-500 hover:text-red-400 hover:underline text-sm font-semibold">← Kembali</a>
            <h1 class="text-2xl font-bold text-white">Detail Pesanan #{{ $order->id }}</h1>
        </div>
        <a href="/orders/{{ $order->id }}/print" target="_blank" class="flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-bold transition-all shadow-md shadow-red-600/20">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
            Cetak Struk
        </a>
    </div>

    {{-- Status --}}
    @php
        $statusColor = [
            'pending'    => 'bg-yellow-500/10 text-yellow-500 border border-yellow-500/50',
            'processing' => 'bg-blue-500/10 text-blue-500 border border-blue-500/50',
            'shipped'    => 'bg-purple-500/10 text-purple-500 border border-purple-500/50',
            'delivered'  => 'bg-green-500/10 text-green-500 border border-green-500/50',
            'completed'  => 'bg-green-900/10 text-green-600 border border-green-900/50',
        ][$order->status] ?? 'bg-gray-500/10 text-gray-400 border border-gray-500/50';

        $statusLabel = [
            'pending'    => 'Menunggu Konfirmasi',
            'processing' => 'Sedang Diproses',
            'shipped'    => 'Sedang Dikirim',
            'delivered'  => 'Sudah Diterima',
            'completed'  => 'Pemesanan Selesai',
        ][$order->status] ?? $order->status;
    @endphp

    <div class="border rounded-xl p-4 mb-6 {{ $statusColor }}">
        <p class="font-bold text-lg flex items-center gap-2">
            @if($order->status === 'completed') <span class="text-xl">✓</span> @endif
            Status: {{ $statusLabel }}
        </p>
        @if($order->status === 'shipped')
            <p class="text-sm mt-1">Siapkan uang ya, buku segera tiba!</p>
        @elseif($order->status === 'completed')
            <p class="text-sm mt-1 italic text-gray-500">Terima kasih telah berbelanja di BookStore. Pesanan ini sudah diarsipkan.</p>
        @endif
    </div>

    {{-- Info Pengiriman --}}
    <div class="bg-zinc-950 border border-red-900/50 rounded-xl shadow p-6 mb-6">
        <h2 class="font-bold text-white mb-3">Info Pengiriman</h2>
        <p class="text-sm text-gray-400">
            <span class="font-medium text-gray-300">Alamat:</span> {{ $order->shipping_address }}
        </p>
        <p class="text-sm text-gray-400 mt-1">
            <span class="font-medium text-gray-300">Telepon:</span> {{ $order->phone }}
        </p>
        @if($order->notes)
        <p class="text-sm text-gray-400 mt-1">
            <span class="font-medium text-gray-300">Catatan:</span> {{ $order->notes }}
        </p>
        @endif
        <p class="text-sm text-gray-400 mt-1">
            <span class="font-medium text-gray-300">Pembayaran:</span>
            <span class="text-red-500 font-medium">Cash on Delivery (COD)</span>
        </p>
    </div>

    {{-- Daftar Buku --}}
    <div class="bg-zinc-950 border border-red-900/50 rounded-xl shadow p-6 mb-6">
        <h2 class="font-bold text-white mb-4">Buku Dipesan</h2>
        <div class="space-y-4">
            @foreach($order->orderItems as $item)
            <div class="flex gap-4 items-center">
                <img src="{{ $item->book->image ? Storage::url($item->book->image) : 'https://images.unsplash.com/photo-1543002588-bfa74002ed7e?w=100' }}"
                     class="w-16 h-20 object-cover rounded-lg border border-red-900/30">
                <div class="flex-1">
                    <p class="font-medium text-white">{{ $item->book->title }}</p>
                    <p class="text-sm text-gray-500">{{ $item->book->author }}</p>
                    <p class="text-sm text-gray-400 mt-1">
                        Rp {{ number_format($item->price, 0, ',', '.') }} x {{ $item->quantity }}
                    </p>
                </div>
                <p class="font-bold text-red-500">
                    Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                </p>
            </div>
            @endforeach
        </div>
        <hr class="my-4 border-red-900/50">
        <div class="flex justify-between font-bold text-gray-400 mb-2">
            <span>Subtotal</span>
            <span>Rp {{ number_format($order->total_price - $order->shipping_cost, 0, ',', '.') }}</span>
        </div>
        <div class="flex justify-between font-bold text-gray-400 mb-4">
            <span>Biaya Pengiriman</span>
            <span>Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
        </div>
        <div class="flex justify-between font-bold text-white pt-4 border-t border-red-900/50">
            <span>Total Pembayaran</span>
            <span class="text-red-500 text-xl">
                Rp {{ number_format($order->total_price, 0, ',', '.') }}
            </span>
        </div>
    </div>

</div>
@endsection