@extends('layouts.admin')
@section('title', 'Kelola Pesanan')

@section('content')
<div class="flex items-center gap-3 mb-8 border-b-2 border-red-600 pb-4 inline-flex">
    <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
    <h1 class="text-3xl font-extrabold text-white">Kelola Pesanan</h1>
</div>

<div class="bg-zinc-900 border border-red-900/50 rounded-xl shadow-[0_0_15px_rgba(220,38,38,0.1)] overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="bg-black text-red-500 uppercase text-xs font-bold border-b border-red-900/50">
                <tr>
                    <th class="px-6 py-4">#</th>
                    <th class="px-6 py-4">Pembeli</th>
                    <th class="px-6 py-4">Total</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4">Tanggal</th>
                    <th class="px-6 py-4">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-red-900/30">
                @forelse($orders as $order)
                <tr class="hover:bg-zinc-800 transition-colors {{ $order->status === 'completed' ? 'opacity-50 italic bg-black/50 pointer-events-none grayscale' : '' }}">
                    <td class="px-6 py-4 text-gray-500">{{ $order->id }}</td>
                    <td class="px-6 py-4 font-bold text-white">{{ $order->user->name }}</td>
                    <td class="px-6 py-4 font-bold text-red-500">
                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                    </td>
                    <td class="px-6 py-4">
                        @php
                            $color = [
                                'pending'    => 'bg-yellow-900/20 text-yellow-500 border-yellow-900/50',
                                'processing' => 'bg-blue-900/20 text-blue-400 border-blue-900/50',
                                'shipped'    => 'bg-purple-900/20 text-purple-400 border-purple-900/50',
                                'delivered'  => 'bg-green-900/20 text-green-500 border-green-900/50',
                                'completed'  => 'bg-green-900/10 text-green-700 border-green-900/30',
                            ][$order->status] ?? 'bg-black text-gray-400 border-red-900/50';
                        @endphp
                        <span class="px-3 py-1 rounded-full text-xs font-bold border {{ $color }}">
                            {{ $order->status === 'completed' ? '✓ Selesai' : ucfirst($order->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-gray-400">{{ $order->created_at->format('d M Y') }}</td>
                    <td class="px-6 py-4 pointer-events-auto">
                        <a href="/admin/orders/{{ $order->id }}"
                           class="bg-zinc-800 text-white border border-gray-600 hover:border-white hover:bg-gray-700 px-4 py-1.5 rounded-lg text-xs font-bold transition-all {{ $order->status === 'completed' ? 'opacity-100 not-italic' : '' }}">
                            Detail
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-10 text-center text-gray-500 bg-black">Belum ada pesanan</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-6 py-4 bg-black border-t border-red-900/50">{{ $orders->links() }}</div>
</div>
@endsection
