@extends('layouts.app')
@section('title', 'Pesanan Saya — BookStore')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-10">

    <h1 class="text-3xl font-bold text-gray-800 mb-8">📦 Pesanan Saya</h1>

    @if($orders->count() > 0)
        <div class="space-y-4">
            @foreach($orders as $order)
            <a href="/orders/{{ $order->id }}"
               class="block bg-white rounded-xl shadow hover:shadow-md transition p-5">
                <div class="flex items-center justify-between mb-3">
                    <div>
                        <p class="font-semibold text-gray-800">Order #{{ $order->id }}</p>
                        <p class="text-sm text-gray-500">{{ $order->created_at->format('d M Y, H:i') }}</p>
                    </div>
                    @php
                        $statusColor = [
                            'pending'    => 'bg-yellow-100 text-yellow-700',
                            'processing' => 'bg-blue-100 text-blue-700',
                            'shipped'    => 'bg-purple-100 text-purple-700',
                            'delivered'  => 'bg-green-100 text-green-700',
                            'completed'  => 'bg-gray-100 text-gray-700',
                        ][$order->status] ?? 'bg-gray-100 text-gray-700';
                    @endphp
                    <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $statusColor }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>
                <div class="flex justify-between text-sm text-gray-600">
                    <span>{{ $order->orderItems->count() ?? '-' }} item</span>
                    <span class="font-bold text-indigo-600">
                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                    </span>
                </div>
            </a>
            @endforeach
        </div>

        <div class="mt-6">{{ $orders->links() }}</div>

    @else
        <div class="text-center py-20">
            <p class="text-6xl mb-4">📭</p>
            <p class="text-gray-500 text-lg mb-4">Belum ada pesanan</p>
            <a href="/books"
               class="bg-indigo-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-indigo-700 transition">
                Mulai Belanja
            </a>
        </div>
    @endif

</div>
@endsection