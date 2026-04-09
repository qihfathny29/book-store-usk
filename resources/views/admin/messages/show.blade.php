@extends('layouts.admin')
@section('title', 'Detail Pesan')

@section('content')
<div class="max-w-2xl">
    <div class="flex items-center gap-4 mb-6">
        <a href="/admin/messages" class="text-red-500 hover:underline text-sm">&larr; Kembali</a>
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

        @if($message->admin_reply)
            <div class="mt-6 bg-black border border-green-500/30 rounded-lg p-5">
                <p class="text-xs text-green-400 uppercase font-bold mb-2">Balasan Admin</p>
                <div class="text-white leading-relaxed whitespace-pre-wrap">
                    {{ $message->admin_reply }}
                </div>
            </div>
        @else
            <form action="{{ route('admin.messages.reply', $message->id) }}" method="POST" class="mt-8 border-t border-red-900/50 pt-6">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-bold text-white mb-2">Balas Pesan Ini</label>
                    <textarea name="admin_reply" rows="4" required
                              class="w-full bg-black border border-red-900/50 rounded-xl p-4 text-white
                                     focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-red-600"
                              placeholder="Ketik balasan Anda di sini..."></textarea>
                </div>
                <button type="submit" class="bg-red-600 text-white font-bold px-8 py-3 rounded-xl
                                             hover:bg-red-700 transition shadow-lg shadow-red-500/20">
                    &#10148; Kirim Balasan
                </button>
            </form>
        @endif
    </div>
</div>
@endsection
