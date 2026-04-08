@extends('layouts.app')
@section('title', 'Admin Login — BookStore')

@section('content')
<div class="min-h-screen bg-zinc-950 flex items-center justify-center p-4">
    <div class="w-full max-w-5xl bg-zinc-900 rounded-3xl shadow-2xl overflow-hidden border border-zinc-800">
        <div class="grid md:grid-cols-5 min-h-[620px]">

            <!-- LEFT SIDE: Login Form -->
            <div class="md:col-span-3 p-10 flex flex-col justify-center">
                <div class="max-w-md mx-auto w-full">
                    <h1 class="text-4xl font-bold text-white mb-2">Selamat datang kembali</h1>
                    <p class="text-zinc-400 text-lg mb-8">Masuk ke akun anda</p>

                    <form action="/login" method="POST" class="space-y-6">
                        @csrf

                        <div>
                            <label class="block text-sm font-medium text-zinc-300 mb-2">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}"
                                   class="w-full bg-zinc-800 border border-zinc-700 rounded-2xl px-6 py-4 text-white
                                          focus:outline-none focus:border-red-600 focus:ring-2 focus:ring-red-600/30
                                          placeholder-zinc-500 transition-all"
                                   placeholder="admin@bookstore.com" required>
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-zinc-300 mb-2">Password</label>
                            <input type="password" name="password"
                                   class="w-full bg-zinc-800 border border-zinc-700 rounded-2xl px-6 py-4 text-white
                                          focus:outline-none focus:border-red-600 focus:ring-2 focus:ring-red-600/30
                                          placeholder-zinc-500 transition-all"
                                   placeholder="••••••••" required>
                            @error('password')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit"
                                class="w-full bg-red-600 hover:bg-red-700 active:bg-red-800 
                                       text-white font-semibold py-4 rounded-2xl text-lg
                                       transition-all duration-200 shadow-lg shadow-red-600/40">
                            Masuk
                        </button>
                    </form>

                    <p class="text-center text-zinc-400 mt-8 text-sm">
                        Belum punya akun? 
                        <a href="/register" class="text-red-500 hover:text-red-400 font-medium">Register dulu</a>
                    </p>
                </div>
            </div>

            <!-- RIGHT SIDE: Informasi Panel -->
            <div class="md:col-span-2 bg-zinc-950 p-10 flex flex-col justify-center relative overflow-hidden">
                <div class="max-w-sm">
                    <h2 class="text-3xl font-bold text-white mb-3">Akses Pengetahuan</h2>
                    <p class="text-zinc-400 leading-relaxed">
                        Masuk untuk melanjutkan pembelajaran anda<br>
                        dan mengelola sistem BookStore.
                    </p>
                </div>

                <!-- Placeholder untuk ilustrasi / gambar (bisa diganti nanti) -->
                <div class="mt-auto pt-12">
                    <div class="bg-zinc-900/50 border border-zinc-700 h-80 rounded-3xl flex items-center justify-center">
                        <div class="text-center">
                            <div class="w-20 h-20 mx-auto bg-red-600/10 rounded-2xl flex items-center justify-center mb-4">
                                <span class="text-4xl">📚</span>
                            </div>
                            <p class="text-zinc-500 text-sm">Ilustrasi Admin Dashboard</p>
                        </div>
                    </div>
                </div>

                <!-- Optional subtle accent -->
                <div class="absolute bottom-8 right-8 text-[120px] font-black text-red-600/5 select-none">
                    BS
                </div>
            </div>

        </div>
    </div>
</div>
@endsection