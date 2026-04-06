@extends('layouts.app')
@section('title', 'Login — BookStore')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4">
    <div class="bg-white rounded-2xl shadow-lg p-8 w-full max-w-md">

        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Selamat Datang!</h1>
            <p class="text-gray-500 text-sm mt-1">Login untuk melanjutkan belanja</p>
        </div>

        <form action="/login" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm
                              focus:outline-none focus:ring-2 focus:ring-indigo-500"
                       placeholder="email@kamu.com" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" name="password"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm
                              focus:outline-none focus:ring-2 focus:ring-indigo-500"
                       placeholder="Password kamu" required>
            </div>

            <button type="submit"
                    class="w-full bg-indigo-600 text-white font-semibold py-3 rounded-lg
                           hover:bg-indigo-700 transition">
                Login
            </button>
        </form>

        <p class="text-center text-sm text-gray-500 mt-6">
            Belum punya akun?
            <a href="/register" class="text-indigo-600 font-medium hover:underline">Daftar</a>
        </p>
    </div>
</div>
@endsection