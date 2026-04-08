@extends('layouts.admin')
@section('title', 'Detail Pesan')

@section('content')
<div class="max-w-2xl">
    <div class="flex items-center gap-4 mb-6">
        <a href="/admin/messages" class="text-red-500 hover:underline text-sm">â† Kembali</a>
        <h1 class="text-2xl font-bold text-white">Detail Pesan</h1>
    </div>

    <div class="bg-zinc-900 border border-red-900/50 rounded-xl shadow p-6">
        <div class="space-y-3 mb-6">
            <div>
                <p class="text-xs text-gray-400 uppercase font-medium">Dari</p>
                <p class="font-semibold text-white">{{ $message->name }}</p>
            </div>
            <div>
                <p class="text-xs text-gray-400 uppercase font-medium">Email</p>
                <p class="text-gray-300">{{ $message->email }}</p>
            </div>
            <div>
                <p class="text-xs text-gray-400 uppercase font-medium">Tanggal</p>
                <p class="text-gray-300">{{ $message->created_at->format('d M Y, H:i') }}</p>
            </div>
            <div>
                <p class="text-xs text-gray-400 uppercase font-medium mb-2">Pesan</p>
                <div class="bg-black rounded-lg p-4 text-gray-300 leading-relaxed">
                    {{ $message->message }}
                </div>
            </div>
        </div>

        <a href="mailto:{{ $message->email }}"
           class="inline-block bg-red-600 text-white px-6 py-2 rounded-lg text-sm
                  hover:bg-red-700 transition">
            ðŸ“§ Balas via Email
        </a>
    </div>
</div>
@endsection
