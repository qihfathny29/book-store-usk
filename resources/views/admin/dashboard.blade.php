@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')

<h1 class="text-2xl font-bold text-gray-800 mb-6">Dashboard</h1>

{{-- Stats Cards --}}
<div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-8">
    <div class="bg-white rounded-xl shadow p-5">
        <p class="text-sm text-gray-500">Total Buku</p>
        <p class="text-3xl font-bold text-indigo-600">{{ $stats['total_books'] }}</p>
    </div>
    <div class="bg-white rounded-xl shadow p-5">
        <p class="text-sm text-gray-500">Kategori</p>
        <p class="text-3xl font-bold text-purple-600">{{ $stats['total_categories'] }}</p>
    </div>
    <div class="bg-white rounded-xl shadow p-5">
        <p class="text-sm text-gray-500">Total User</p>
        <p class="text-3xl font-bold text-blue-600">{{ $stats['total_users'] }}</p>
    </div>
    <div class="bg-white rounded-xl shadow p-5">
        <p class="text-sm text-gray-500">Total Pesanan</p>
        <p class="text-3xl font-bold text-green-600">{{ $stats['total_orders'] }}</p>
    </div>
    <div class="bg-white rounded-xl shadow p-5">
        <p class="text-sm text-gray-500">Pesanan Pending</p>
        <p class="text-3xl font-bold text-yellow-500">{{ $stats['pending_orders'] }}</p>
    </div>
    <div class="bg-white rounded-xl shadow p-5">
        <p class="text-sm text-gray-500">Pesan Belum Dibaca</p>
        <p class="text-3xl font-bold text-red-500">{{ $stats['unread_messages'] }}</p>
    </div>
</div>

{{-- Recent Orders & Messages --}}
<div class="grid md:grid-cols-2 gap-6">

    {{-- Recent Orders --}}
    <div class="bg-white rounded-xl shadow p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="font-bold text-gray-800">Pesanan Terbaru</h2>
            <a href="/admin/orders" class="text-xs text-indigo-600 hover:underline">Lihat semua</a>
        </div>
        <div class="space-y-3">
            @forelse($recentOrders as $order)
            <div class="flex items-center justify-between text-sm">
                <div>
                    <p class="font-medium text-gray-800">{{ $order->user->name }}</p>
                    <p class="text-gray-500 text-xs">Order #{{ $order->id }}</p>
                </div>
                <span class="px-2 py-1 rounded-full text-xs font-medium
                    {{ $order->status === 'pending' ? 'bg-yellow-100 text-yellow-700' :
                      ($order->status === 'completed' ? 'bg-gray-100 text-gray-600' :
                       'bg-blue-100 text-blue-700') }}">
                    {{ ucfirst($order->status) }}
                </span>
            </div>
            @empty
            <p class="text-gray-400 text-sm">Belum ada pesanan</p>
            @endforelse
        </div>
    </div>

    {{-- Recent Messages --}}
    <div class="bg-white rounded-xl shadow p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="font-bold text-gray-800">Pesan Terbaru</h2>
            <a href="/admin/messages" class="text-xs text-indigo-600 hover:underline">Lihat semua</a>
        </div>
        <div class="space-y-3">
            @forelse($recentMessages as $message)
            <div class="flex items-center justify-between text-sm">
                <div>
                    <p class="font-medium text-gray-800 flex items-center gap-1">
                        {{ $message->name }}
                        @if(!$message->is_read)
                            <span class="w-2 h-2 rounded-full bg-red-500 inline-block"></span>
                        @endif
                    </p>
                    <p class="text-gray-500 text-xs line-clamp-1">{{ $message->message }}</p>
                </div>
                <a href="/admin/messages/{{ $message->id }}"
                   class="text-indigo-600 text-xs hover:underline">Baca</a>
            </div>
            @empty
            <p class="text-gray-400 text-sm">Belum ada pesan</p>
            @endforelse
        </div>
    </div>
</div>

@endsection