@extends('layouts.app')
@section('title', 'Contact — BookStore')

@section('content')
<div class="max-w-2xl mx-auto px-4 py-16">

    <div class="text-center mb-10">
        <h1 class="text-4xl font-bold text-gray-800 mb-3">Hubungi Kami</h1>
        <p class="text-gray-500">Ada pertanyaan? Kirim pesan dan kami akan segera merespons</p>
    </div>

    <div class="bg-white rounded-2xl shadow p-8">
        <form action="/contact" method="POST" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                <input type="text" name="name"
                       value="{{ session('user')['name'] ?? old('name') }}"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm
                              focus:outline-none focus:ring-2 focus:ring-indigo-500"
                       placeholder="Nama lengkap kamu" required>
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email"
                       value="{{ session('user')['email'] ?? old('email') }}"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm
                              focus:outline-none focus:ring-2 focus:ring-indigo-500"
                       placeholder="email@kamu.com" required>
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Pesan</label>
                <textarea name="message" rows="5"
                          class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm
                                 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                          placeholder="Tulis pesanmu di sini..." required></textarea>
                @error('message')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                    class="w-full bg-indigo-600 text-white font-semibold py-3 rounded-lg
                           hover:bg-indigo-700 transition">
                Kirim Pesan
            </button>
        </form>
    </div>

</div>
@endsection