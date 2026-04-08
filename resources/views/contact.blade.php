@extends('layouts.app')
@section('title', 'Contact — BookStore')

@section('content')
<div class="max-w-2xl mx-auto px-4 py-16 min-h-screen">

    <div class="text-center mb-10">
        <h1 class="text-4xl font-bold text-white mb-3">Hubungi Kami</h1>
        <p class="text-gray-400">Ada pertanyaan? Kirim pesan dan kami akan segera merespons</p>
    </div>

    <div class="bg-zinc-950 rounded-2xl shadow-xl shadow-red-900/10 border border-red-900/40 p-8">
        <form action="/contact" method="POST" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-bold text-gray-300 mb-1">Nama</label>
                <input type="text" name="name"
                       value="{{ session('user')['name'] ?? old('name') }}"
                       class="w-full bg-black text-white border border-red-900 rounded-lg px-4 py-3 text-sm
                              focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-red-600 placeholder-gray-600 transition-all"
                       placeholder="Nama lengkap kamu" required>
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-300 mb-1">Email</label>
                <input type="email" name="email"
                       value="{{ session('user')['email'] ?? old('email') }}"
                       class="w-full bg-black text-white border border-red-900 rounded-lg px-4 py-3 text-sm
                              focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-red-600 placeholder-gray-600 transition-all"
                       placeholder="email@kamu.com" required>
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-300 mb-1">Pesan</label>
                <textarea name="message" rows="5"
                          class="w-full bg-black text-white border border-red-900 rounded-lg px-4 py-3 text-sm
                                 focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-red-600 placeholder-gray-600 transition-all"
                          placeholder="Tulis pesanmu di sini..." required></textarea>
                @error('message')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                    class="w-full bg-red-600 text-white font-bold py-3 rounded-lg
                           hover:bg-red-700 hover:shadow-lg hover:shadow-red-600/30 transition-all mt-4">
                Kirim Pesan
            </button>
        </form>
    </div>
</div>
@endsection
