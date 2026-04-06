@extends('layouts.admin')
@section('title', 'Detail Pesan')

@section('content')
<div class="max-w-2xl">
    <div class="flex items-center gap-4 mb-6">
        <a href="/admin/messages" class="text-indigo-600 hover:underline text-sm">← Kembali</a>
        <h1 class="text-2xl font-bold text-gray-800">Detail Pesan</h1>
    </div>

    <div class="bg-white rounded-xl shadow p-6">
        <div class="space-y-3 mb-6">
            <div>
                <p class="text-xs text-gray-400 uppercase font-medium">Dari</p>
                <p class="font-semibold text-gray-800">{{ $message->name }}</p>
            </div>
            <div>
                <p class="text-xs text-gray-400 uppercase font-medium">Email</p>
                <p class="text-gray-700">{{ $message->email }}</p>
            </div>
            <div>
                <p class="text-xs text-gray-400 uppercase font-medium">Tanggal</p>
                <p class="text-gray-700">{{ $message->created_at->format('d M Y, H:i') }}</p>
            </div>
            <div>
                <p class="text-xs text-gray-400 uppercase font-medium mb-2">Pesan</p>
                <div class="bg-gray-50 rounded-lg p-4 text-gray-700 leading-relaxed">
                    {{ $message->message }}
                </div>
            </div>
        </div>

        <a href="mailto:{{ $message->email }}"
           class="inline-block bg-indigo-600 text-white px-6 py-2 rounded-lg text-sm
                  hover:bg-indigo-700 transition">
            📧 Balas via Email
        </a>
    </div>
</div>
@endsection