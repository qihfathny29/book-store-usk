@extends('layouts.admin')
@section('title', 'Pesan Masuk')

@section('content')
<div class="flex items-center gap-3 mb-8 border-b-2 border-red-600 pb-4 inline-flex">
    <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
    <h1 class="text-3xl font-extrabold text-white">Pesan Masuk</h1>
</div>

<div class="bg-zinc-900 border border-red-900/50 rounded-xl shadow-[0_0_15px_rgba(220,38,38,0.1)] overflow-hidden">
    <table class="w-full text-sm text-left">
        <thead class="bg-black text-red-500 uppercase text-xs font-bold border-b border-red-900/50">
            <tr>
                <th class="px-6 py-4">#</th>
                <th class="px-6 py-4">Pengirim</th>
                <th class="px-6 py-4">Email</th>
                <th class="px-6 py-4">Pesan</th>
                <th class="px-6 py-4">Status</th>
                <th class="px-6 py-4">Tanggal</th>
                <th class="px-6 py-4">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-red-900/30">
            @forelse($messages as $message)
            <tr class="hover:bg-zinc-800 transition-colors {{ !$message->is_read ? 'bg-red-900/10 border-l-4 border-red-600' : '' }}">
                <td class="px-6 py-4 text-gray-500">{{ $loop->iteration }}</td>
                <td class="px-6 py-4 font-bold text-white">{{ $message->name }}</td>
                <td class="px-6 py-4 text-red-400 font-medium">{{ $message->email }}</td>
                <td class="px-6 py-4 text-gray-400 max-w-xs">
                    <p class="line-clamp-1 border-l-2 border-red-900/50 pl-2">{{ $message->message }}</p>
                </td>
                <td class="px-6 py-4">
                    @if(!$message->is_read)
                        <span class="bg-red-900/40 text-red-500 border border-red-900/50 px-3 py-1.5 rounded-lg text-xs font-bold shadow-[0_0_10px_rgba(220,38,38,0.3)] animate-pulse">
                            Belum Dibaca
                        </span>
                    @else
                        <span class="bg-black text-gray-500 border border-zinc-800 px-3 py-1.5 rounded-lg text-xs font-medium">
                            Dibaca
                        </span>
                    @endif
                </td>
                <td class="px-6 py-4 text-gray-500">{{ $message->created_at->format('d M Y') }}</td>
                <td class="px-6 py-4">
                    <a href="/admin/messages/{{ $message->id }}"
                       class="bg-zinc-800 text-white border border-gray-600 hover:border-white hover:bg-gray-700 px-4 py-1.5 rounded-lg text-xs font-bold transition-all">
                        Baca
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="px-6 py-10 text-center text-gray-500 bg-black">Belum ada pesan</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="px-6 py-4 bg-black border-t border-red-900/50">{{ $messages->links() }}</div>
</div>
@endsection
