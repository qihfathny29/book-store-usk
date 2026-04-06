@extends('layouts.app')
@section('title', 'Register — BookStore')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4">
    <div class="bg-white rounded-2xl shadow-lg p-8 w-full max-w-md">

        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Daftar Akun</h1>
            <p class="text-gray-500 text-sm mt-1">Buat akun untuk mulai berbelanja</p>
        </div>

        <form action="/register" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name') }}"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm
                              focus:outline-none focus:ring-2 focus:ring-indigo-500"
                       placeholder="Nama lengkap" required>
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm
                              focus:outline-none focus:ring-2 focus:ring-indigo-500"
                       placeholder="email@kamu.com" required>
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">No. Telepon</label>
                <input type="text" name="phone" value="{{ old('phone') }}"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm
                              focus:outline-none focus:ring-2 focus:ring-indigo-500"
                       placeholder="08xxxxxxxxxx">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                <textarea name="address" rows="2"
                          class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm
                                 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                          placeholder="Alamat lengkap">{{ old('address') }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" name="password"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm
                              focus:outline-none focus:ring-2 focus:ring-indigo-500"
                       placeholder="Minimal 6 karakter" required>
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                <input type="password" name="password_confirmation"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm
                              focus:outline-none focus:ring-2 focus:ring-indigo-500"
                       placeholder="Ulangi password" required>
            </div>

            <button type="submit"
                    class="w-full bg-indigo-600 text-white font-semibold py-3 rounded-lg
                           hover:bg-indigo-700 transition mt-2">
                Daftar Sekarang
            </button>
        </form>

        <p class="text-center text-sm text-gray-500 mt-6">
            Sudah punya akun?
            <a href="/login" class="text-indigo-600 font-medium hover:underline">Login</a>
        </p>
    </div>
</div>
@endsection