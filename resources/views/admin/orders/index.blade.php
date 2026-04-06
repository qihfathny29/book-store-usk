@extends('layouts.admin')
@section('title', 'Kelola Pesanan')

@section('content')
<h1 class="text-2xl font-bold text-gray-800 mb-6">📦 Kelola Pesanan</h1>

<div class="bg-white rounded-xl shadow overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
            <tr>
                <th class="px-6 py-3 text-left">#</th>
                <th class="px-6 py-3 text-left">Pembeli</th>
                <th class="px-6 py-3 text-left">Total</th>
                <th class="px-6 py-3 text-left">Status</th>
                <th class="px-6 py-3 text-left">Tanggal</th>
                <th class="px-6 py-3 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($orders as $order)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 text-gray-500">{{ $order->id }}</td>
                <td class="px-6 py-4 font-medium text-gray-800">{{ $order->user->name }}</td>
                <td class="px-6 py-4 font-medium text-indigo-600">
                    Rp {{ number_format($order->total_price, 0, ',', '.') }}
                </td>
                <td class="px-6 py-4">
                    @php
                        $color = [
                            'pending'    => 'bg-yellow-100 text-yellow-700',
                            'processing' => 'bg-blue-100 text-blue-700',
                            'shipped'    => 'bg-purple-100 text-purple-700',
                            'delivered'  => 'bg-green-100 text-green-700',
                            'completed'  => 'bg-gray-100 text-gray-600',
                        ][$order->status] ?? 'bg-gray-100';
                    @endphp
                    <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $color }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </td>
                <td class="px-6 py-4 text-gray-500">{{ $order->created_at->format('d M Y') }}</td>
                <td class="px-6 py-4">
                    <a href="/admin/orders/{{ $order->id }}"
                       class="bg-indigo-100 text-indigo-700 px-3 py-1 rounded-lg text-xs hover:bg-indigo-200">
                        Detail
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-10 text-center text-gray-400">Belum ada pesanan</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="px-6 py-4">{{ $orders->links() }}</div>
</div>
@endsection