@extends('layouts.admin')
@section('title', 'Pesan Masuk')

@section('content')
<h1 class="text-2xl font-bold text-gray-800 mb-6">💬 Pesan Masuk</h1>

<div class="bg-white rounded-xl shadow overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
            <tr>
                <th class="px-6 py-3 text-left">#</th>
                <th class="px-6 py-3 text-left">Pengirim</th>
                <th class="px-6 py-3 text-left">Email</th>
                <th class="px-6 py-3 text-left">Pesan</th>
                <th class="px-6 py-3 text-left">Status</th>
                <th class="px-6 py-3 text-left">Tanggal</th>
                <th class="px-6 py-3 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($messages as $message)
            <tr class="hover:bg-gray-50 {{ !$message->is_read ? 'bg-indigo-50' : '' }}">
                <td class="px-6 py-4 text-gray-500">{{ $loop->iteration }}</td>
                <td class="px-6 py-4 font-medium text-gray-800">{{ $message->name }}</td>
                <td class="px-6 py-4 text-gray-600">{{ $message->email }}</td>
                <td class="px-6 py-4 text-gray-600 max-w-xs">
                    <p class="line-clamp-1">{{ $message->message }}</p>
                </td>
                <td class="px-6 py-4">
                    @if(!$message->is_read)
                        <span class="bg-red-100 text-red-600 px-2 py-1 rounded-full text-xs font-medium">
                            Belum Dibaca
                        </span>
                    @else
                        <span class="bg-gray-100 text-gray-500 px-2 py-1 rounded-full text-xs">
                            Dibaca
                        </span>
                    @endif
                </td>
                <td class="px-6 py-4 text-gray-500">{{ $message->created_at->format('d M Y') }}</td>
                <td class="px-6 py-4">
                    <a href="/admin/messages/{{ $message->id }}"
                       class="bg-indigo-100 text-indigo-700 px-3 py-1 rounded-lg text-xs hover:bg-indigo-200">
                        Baca
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="px-6 py-10 text-center text-gray-400">Belum ada pesan</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="px-6 py-4">{{ $messages->links() }}</div>
</div>
@endsection