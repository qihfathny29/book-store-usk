@extends('layouts.admin')
@section('title', 'Detail Pesanan')

@section('content')
<div class="max-w-3xl">
    <div class="flex items-center gap-4 mb-6">
        <a href="/admin/orders" class="text-indigo-600 hover:underline text-sm">← Kembali</a>
        <h1 class="text-2xl font-bold text-gray-800">Detail Pesanan #{{ $order->id }}</h1>
    </div>

    {{-- Info Pembeli --}}
    <div class="bg-white rounded-xl shadow p-6 mb-4">
        <h2 class="font-bold text-gray-800 mb-3">👤 Info Pembeli</h2>
        <p class="text-sm text-gray-600"><span class="font-medium">Nama:</span> {{ $order->user->name }}</p>
        <p class="text-sm text-gray-600 mt-1"><span class="font-medium">Email:</span> {{ $order->user->email }}</p>
        <p class="text-sm text-gray-600 mt-1"><span class="font-medium">Telepon:</span> {{ $order->phone }}</p>
        <p class="text-sm text-gray-600 mt-1"><span class="font-medium">Alamat:</span> {{ $order->shipping_address }}</p>
        @if($order->notes)
        <p class="text-sm text-gray-600 mt-1"><span class="font-medium">Catatan:</span> {{ $order->notes }}</p>
        @endif
    </div>

    {{-- Daftar Buku --}}
    <div class="bg-white rounded-xl shadow p-6 mb-4">
        <h2 class="font-bold text-gray-800 mb-4">📚 Buku Dipesan</h2>
        <div class="space-y-3">
            @foreach($order->orderItems as $item)
            <div class="flex gap-4 items-center">
                <img src="{{ $item->book->image ? Storage::url($item->book->image) : 'https://images.unsplash.com/photo-1543002588-bfa74002ed7e?w=100' }}"
                     class="w-14 h-16 object-cover rounded">
                <div class="flex-1">
                    <p class="font-medium text-gray-800">{{ $item->book->title }}</p>
                    <p class="text-sm text-gray-500">x{{ $item->quantity }} @ Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                </div>
                <p class="font-bold text-indigo-600">
                    Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                </p>
            </div>
            @endforeach
        </div>
        <hr class="my-4">
        <div class="flex justify-between font-bold">
            <span>Total</span>
            <span class="text-indigo-600">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
        </div>
    </div>

    {{-- Update Status --}}
    <div class="bg-white rounded-xl shadow p-6">
        <h2 class="font-bold text-gray-800 mb-4">🔄 Update Status Pesanan</h2>
        <form action="/admin/orders/{{ $order->id }}" method="POST" class="flex gap-3">
            @csrf
            @method('PATCH')
            <select name="status"
                    class="flex-1 border border-gray-300 rounded-lg px-4 py-2 text-sm
                           focus:outline-none focus:ring-2 focus:ring-indigo-500">
                @foreach(['pending','processing','shipped','delivered','completed'] as $status)
                    <option value="{{ $status }}" {{ $order->status === $status ? 'selected' : '' }}>
                        {{ ucfirst($status) }}
                    </option>
                @endforeach
            </select>
            <button type="submit"
                    class="bg-indigo-600 text-white px-6 py-2 rounded-lg text-sm hover:bg-indigo-700 transition">
                Update
            </button>
        </form>
    </div>
</div>
@endsection