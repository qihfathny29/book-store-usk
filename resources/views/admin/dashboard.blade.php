@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')

<div class="flex justify-between items-center mb-8 pb-4 border-b-2 border-red-600">
    <h1 class="text-3xl font-extrabold text-white">Dashboard</h1>
    <div class="flex items-center gap-3">
        <a href="{{ route('admin.report.excel') }}" class="bg-green-600 hover:bg-green-700 text-white px-5 py-2.5 rounded-xl font-bold flex items-center gap-2 shadow-lg shadow-green-600/20 transition-all border border-green-500 text-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"></path></svg>
            Download Excel
        </a>
        <a href="{{ route('admin.report.pdf') }}" target="_blank" class="bg-red-600 hover:bg-red-700 text-white px-5 py-2.5 rounded-xl font-bold flex items-center gap-2 shadow-lg shadow-red-600/20 transition-all border border-red-500 text-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"></path></svg>
            Download PDF
        </a>
    </div>
</div>

{{-- Analytics Cards --}}
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
    <div class="bg-black border border-red-500 rounded-xl shadow-[0_0_15px_rgba(220,38,38,0.2)] p-6 flex items-center justify-between">
        <div>
            <p class="text-sm text-gray-400 font-medium uppercase tracking-wider mb-2">Total Pendapatan</p>
            <p class="text-4xl font-extrabold text-red-500">Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}</p>
        </div>
        <div class="bg-red-900/20 p-4 rounded-xl text-red-500">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
    </div>
    <div class="bg-black border border-red-900/50 rounded-xl shadow-[0_0_15px_rgba(220,38,38,0.1)] p-6 flex items-center justify-between">
        <div>
            <p class="text-sm text-gray-400 font-medium uppercase tracking-wider mb-2">Buku Terjual</p>
            <p class="text-4xl font-extrabold text-white">{{ $stats['books_sold'] }} <span class="text-sm font-normal text-gray-500">Buku</span></p>
        </div>
        <div class="bg-zinc-900 p-4 rounded-xl text-gray-400 border border-zinc-800">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path></svg>
        </div>
    </div>
</div>

{{-- Stats Cards --}}
<div class="grid grid-cols-2 md:grid-cols-3 gap-6 mb-10">
    <div class="bg-zinc-900 border border-red-900/50 rounded-xl shadow-[0_0_15px_rgba(220,38,38,0.1)] p-6 hover:shadow-red-600/20 hover:-translate-y-1 transition-all">
        <p class="text-sm text-gray-400 font-medium uppercase tracking-wider mb-2">Total Buku</p>
        <p class="text-4xl font-extrabold text-red-500">{{ $stats['total_books'] }}</p>
    </div>
    <div class="bg-zinc-900 border border-red-900/50 rounded-xl shadow-[0_0_15px_rgba(220,38,38,0.1)] p-6 hover:shadow-red-600/20 hover:-translate-y-1 transition-all">
        <p class="text-sm text-gray-400 font-medium uppercase tracking-wider mb-2">Kategori</p>
        <p class="text-4xl font-extrabold text-white">{{ $stats['total_categories'] }}</p>
    </div>
    <div class="bg-zinc-900 border border-red-900/50 rounded-xl shadow-[0_0_15px_rgba(220,38,38,0.1)] p-6 hover:shadow-red-600/20 hover:-translate-y-1 transition-all">
        <p class="text-sm text-gray-400 font-medium uppercase tracking-wider mb-2">Total User</p>
        <p class="text-4xl font-extrabold text-red-500">{{ $stats['total_users'] }}</p>
    </div>
    <div class="bg-zinc-900 border border-red-900/50 rounded-xl shadow-[0_0_15px_rgba(220,38,38,0.1)] p-6 hover:shadow-red-600/20 hover:-translate-y-1 transition-all">
        <p class="text-sm text-gray-400 font-medium uppercase tracking-wider mb-2">Total Pesanan</p>
        <p class="text-4xl font-extrabold text-white">{{ $stats['total_orders'] }}</p>
    </div>
    <div class="bg-zinc-900 border border-red-900/50 rounded-xl shadow-[0_0_15px_rgba(220,38,38,0.1)] p-6 hover:shadow-red-600/20 hover:-translate-y-1 transition-all">
        <p class="text-sm text-gray-400 font-medium uppercase tracking-wider mb-2">Pesanan Pending</p>
        <p class="text-4xl font-extrabold text-red-500">{{ $stats['pending_orders'] }}</p>
    </div>
    <div class="bg-zinc-900 border border-red-900/50 rounded-xl shadow-[0_0_15px_rgba(220,38,38,0.1)] p-6 hover:shadow-red-600/20 hover:-translate-y-1 transition-all">
        <p class="text-sm text-gray-400 font-medium uppercase tracking-wider mb-2">Pesan Belum Dibaca</p>
        <p class="text-4xl font-extrabold text-white">{{ $stats['unread_messages'] }}</p>
    </div>
</div>

{{-- Recent Orders & Messages --}}
<div class="grid md:grid-cols-2 gap-8">

    {{-- Recent Orders --}}
    <div class="bg-zinc-900 border border-red-900/50 rounded-xl shadow-lg p-6">
        <div class="flex justify-between items-center mb-6 pb-4 border-b border-red-900/30">
            <h2 class="font-bold text-white text-lg flex items-center gap-2">
                <span class="text-red-500">??</span> Pesanan Terbaru
            </h2>
            <a href="/admin/orders" class="text-xs font-semibold text-red-500 hover:text-white hover:underline bg-red-900/20 px-3 py-1 rounded-full">Lihat semua</a>
        </div>
        <div class="space-y-4">
            @forelse($recentOrders as $order)
            <div class="flex items-center justify-between text-sm bg-black px-4 py-3 rounded-lg border border-red-900/20 hover:border-red-600/50 transition">
                <div>
                    <p class="font-bold text-white">{{ $order->user->name }}</p>
                    <p class="text-red-500 text-xs font-medium">Order #{{ $order->id }}</p>
                </div>
                <span class="px-3 py-1 rounded-full text-xs font-bold border
                    {{ $order->status === 'pending' ? 'bg-yellow-900/20 text-yellow-500 border-yellow-900/50' :
                      ($order->status === 'completed' ? 'bg-green-900/20 text-green-500 border-green-900/50' :
                       'bg-blue-900/20 text-blue-400 border-blue-900/50') }}">
                    {{ ucfirst($order->status) }}
                </span>
            </div>
            @empty
            <p class="text-gray-500 text-sm text-center py-4 bg-black rounded-lg border border-dashed border-red-900/50">Belum ada pesanan</p>
            @endforelse
        </div>
    </div>

    {{-- Recent Messages --}}
    <div class="bg-zinc-900 border border-red-900/50 rounded-xl shadow-lg p-6">
        <div class="flex justify-between items-center mb-6 pb-4 border-b border-red-900/30">
            <h2 class="font-bold text-white text-lg flex items-center gap-2">
                <span class="text-red-500">??</span> Pesan Terbaru
            </h2>
            <a href="/admin/messages" class="text-xs font-semibold text-red-500 hover:text-white hover:underline bg-red-900/20 px-3 py-1 rounded-full">Lihat semua</a>
        </div>
        <div class="space-y-4">
            @forelse($recentMessages as $message)
            <div class="flex items-center justify-between text-sm bg-black px-4 py-3 rounded-lg border border-red-900/20 hover:border-red-600/50 transition">
                <div class="flex-1 mr-4">
                    <p class="font-bold text-white flex items-center gap-2 mb-1">
                        {{ $message->name }}
                        @if(!$message->is_read)
                            <span class="px-2 py-0.5 rounded-full bg-red-600 text-white text-[10px] font-extrabold uppercase tracking-wide">Baru</span>
                        @endif
                    </p>
                    <p class="text-gray-400 text-xs line-clamp-1 break-all">{{ $message->message }}</p>
                </div>
                <a href="/admin/messages/{{ $message->id }}"
                   class="flex-shrink-0 text-red-500 font-bold text-xs bg-red-900/20 hover:bg-red-600 hover:text-white px-3 py-1.5 rounded-lg transition">Buka</a>
            </div>
            @empty
            <p class="text-gray-500 text-sm text-center py-4 bg-black rounded-lg border border-dashed border-red-900/50">Belum ada pesan</p>
            @endforelse
        </div>
    </div>
</div>

@endsection
