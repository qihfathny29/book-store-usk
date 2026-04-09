@extends('layouts.admin')
@section('title', 'Detail Pesanan')

@section('content')
<div class="max-w-3xl">
    <div class="flex items-center gap-4 mb-6">
        <a href="/admin/orders" class="text-red-500 hover:underline text-sm">&larr; Kembali</a>
        <h1 class="text-2xl font-bold text-white">Detail Pesanan #{{ $order->id }}</h1>
    </div>

    {{-- Info Pembeli --}}
    <div class="bg-zinc-900 border border-red-900/50 rounded-xl shadow p-6 mb-4">
        <h2 class="font-bold text-white mb-3 text-lg border-b border-red-900/30 pb-2">Info Pembeli</h2>
        <p class="text-sm text-gray-400 mt-2"><span class="font-medium text-gray-500">Nama:</span> <span class="text-white">{{ $order->user->name }}</span></p>
        <p class="text-sm text-gray-400 mt-2"><span class="font-medium text-gray-500">Email:</span> <span class="text-white">{{ $order->user->email }}</span></p>
        <p class="text-sm text-gray-400 mt-2"><span class="font-medium text-gray-500">Telepon:</span> <span class="text-white">{{ $order->phone }}</span></p>
        <p class="text-sm text-gray-400 mt-2"><span class="font-medium text-gray-500">Alamat:</span> <span class="text-white">{{ $order->shipping_address }}</span></p>
        @if($order->notes)
        <p class="text-sm text-gray-400 mt-2"><span class="font-medium text-gray-500">Catatan:</span> <span class="text-yellow-500">{{ $order->notes }}</span></p>
        @endif
    </div>

    {{-- Daftar Buku --}}
    <div class="bg-zinc-900 border border-red-900/50 rounded-xl shadow p-6 mb-4">
        <h2 class="font-bold text-white mb-4 text-lg border-b border-red-900/30 pb-2">Buku Dipesan</h2>
        <div class="space-y-3">
            @foreach($order->orderItems as $item)
            <div class="flex gap-4 items-center">
                <img src="{{ $item->book->image ? Storage::url($item->book->image) : 'https://images.unsplash.com/photo-1543002588-bfa74002ed7e?w=100' }}"
                     class="w-14 h-16 object-cover rounded">
                <div class="flex-1">
                    <p class="font-medium text-white">{{ $item->book->title }}</p>
                    <p class="text-sm text-gray-500">x{{ $item->quantity }} @ Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                </div>
                <p class="font-bold text-red-500">
                    Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                </p>
            </div>
            @endforeach
        </div>
        <hr class="my-4">
          <div class="flex justify-between text-gray-400 mb-2">
              <span>Subtotal</span>
              <span>Rp {{ number_format($order->total_price - $order->shipping_cost, 0, ',', '.') }}</span>
          </div>
          <div class="flex justify-between text-gray-400 mb-4">
              <span>Biaya Pengiriman</span>
              <span>Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
          </div>
          <div class="flex justify-between font-bold pt-4 border-t border-zinc-800">
              <span class="text-white">Total</span>
    </div>

    {{-- Update Status --}}
    @if($order->status === 'completed')
    <div class="bg-black/50 border border-green-900/30 rounded-xl shadow p-6 mb-8 mt-6 text-center">
        <h2 class="font-bold text-green-500 mb-2 text-lg">✓ Pesanan Selesai</h2>
        <p class="text-sm text-gray-500 italic">Pesanan ini telah diselesaikan dan statusnya tidak dapat diubah lagi. Dokumen telah menjadi arsip permanen.</p>
    </div>
    @else
    <div class="bg-zinc-900 border border-red-900/50 rounded-xl shadow p-6 mb-8 mt-6">
        <h2 class="font-bold text-white mb-4 text-lg border-b border-red-900/30 pb-2">Update Status Pesanan</h2>
        <form action="/admin/orders/{{ $order->id }}" method="POST" class="flex gap-3 mt-4">
            @csrf
            @method('PATCH')
            <select name="status"
                    class="flex-1 bg-black border border-red-900/50 rounded-xl px-4 py-2 text-sm text-white
                           focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-red-600 appearance-none">
                @foreach(['pending','processing','shipped','delivered','completed'] as $status)
                    <option value="{{ $status }}" class="bg-zinc-900 text-white py-2" {{ $order->status === $status ? 'selected' : '' }}>
                        {{ ucfirst($status) }}
                    </option>
                @endforeach
            </select>
            <button type="submit"
                    class="bg-red-600 text-white font-bold px-6 py-2 rounded-xl text-sm border border-red-500 hover:bg-red-700 shadow-lg shadow-red-600/20 transition cursor-pointer">
                Update Status
            </button>
        </form>
    </div>
    @endif

</div>
@endsection
