@extends('layouts.user')
@section('title', 'Pesanan Saya — BookStore')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-10">

    <h1 class="text-3xl font-bold text-white mb-8">📦 Pesanan Saya</h1>

    @if($orders->count() > 0)
        <div class="space-y-4">
            @foreach($orders as $order)
            <a href="/orders/{{ $order->id }}"
               class="block bg-zinc-950 border border-red-900/50 rounded-xl shadow hover:-translate-y-1 transition p-5 {{ $order->status === 'completed' ? 'opacity-50 italic pointer-events-none' : '' }}">
                <div class="flex items-center justify-between mb-3">
                    <div>
                        <p class="font-semibold text-white">Order #{{ $order->id }}</p>
                        <p class="text-sm text-gray-400">{{ $order->created_at->format('d M Y, H:i') }}</p>
                    </div>
                    @php
                        $statusColor = [
                            'pending'    => 'border border-yellow-500/50 text-yellow-500 bg-yellow-500/10',
                            'processing' => 'border border-blue-500/50 text-blue-500 bg-blue-500/10',
                            'shipped'    => 'border border-purple-500/50 text-purple-500 bg-purple-500/10',
                            'delivered'  => 'border border-green-500/50 text-green-500 bg-green-500/10',
                            'completed'  => 'border border-green-900 text-green-700 bg-green-900/10',
                        ][$order->status] ?? 'border border-gray-500/50 text-gray-400 bg-gray-500/10';
                    @endphp
                    <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $statusColor }}">
                        {{ $order->status === 'completed' ? '✓ Selesai' : ucfirst($order->status) }}
                    </span>
                </div>
                <div class="flex justify-between items-center text-sm text-gray-400">
                    <span>Total Item: {{ $order->orderItems->count() ?? '-' }} item</span>
                    <div class="flex items-center gap-4">
                        <span class="font-bold text-red-500 text-lg">
                            Rp {{ number_format($order->total_price, 0, ',', '.') }}
                        </span>
                        <div class="pointer-events-auto">
                            <span class="bg-red-600/20 text-red-500 border border-red-600/50 px-3 py-1.5 rounded-lg font-bold text-xs hover:bg-red-600 hover:text-white transition-all {{ $order->status === 'completed' ? 'opacity-100 not-italic' : '' }}">Lihat Detail</span>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>

        <div class="mt-6">{{ $orders->links() }}</div>

    @else
        <div class="text-center py-20">
            <p class="text-6xl mb-4">📭</p>
            <p class="text-gray-400 text-lg mb-4">Belum ada pesanan</p>
            <a href="/books"
               class="bg-red-600 font-bold text-white px-8 py-3 rounded-lg font-semibold hover:bg-red-700 transition">
                Mulai Belanja
            </a>
        </div>
    @endif

</div>
@endsection
