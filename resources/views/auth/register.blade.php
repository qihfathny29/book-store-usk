@extends('layouts.app')
@section('title', 'Register — BookStore')

@section('content')
<div class="min-h-screen bg-zinc-950 flex items-center justify-center p-4">
    <div class="w-full max-w-5xl bg-zinc-900 rounded-3xl shadow-2xl overflow-hidden border border-zinc-800">
        <div class="grid md:grid-cols-5 min-h-[680px]">

            <!-- LEFT SIDE: Penjelasan / Informasi -->
            <div class="md:col-span-2 bg-zinc-950 p-10 flex flex-col justify-center relative overflow-hidden">
                <div class="max-w-sm">
                    <h2 class="text-3xl font-bold text-white mb-3">Buat Akun Admin</h2>
                    <p class="text-zinc-400 leading-relaxed text-lg">
                        Daftar sekarang untuk mendapatkan akses penuh<br>
                        mengelola BookStore dan semua data pengetahuan.
                    </p>
                </div>

                <!-- Placeholder visual -->
                <div class="mt-auto pt-16">
                    <div class="bg-zinc-900/50 border border-zinc-700 h-80 rounded-3xl flex items-center justify-center">
                        <div class="text-center">
                            <div class="w-24 h-24 mx-auto bg-red-600/10 rounded-3xl flex items-center justify-center mb-6">
                                <span class="text-5xl">👤</span>
                            </div>
                            <p class="text-zinc-500 text-sm">Register Akun Administrator</p>
                        </div>
                    </div>
                </div>

                <div class="absolute bottom-8 right-8 text-[120px] font-black text-red-600/5 select-none">
                    BS
                </div>
            </div>

            <!-- RIGHT SIDE: Form Register -->
            <div class="md:col-span-3 p-8 flex flex-col justify-center">
                <div class="max-w-xl mx-auto w-full">
                    <h1 class="text-3xl font-bold text-white mb-2">Daftar Akun</h1>
                    <p class="text-zinc-400 mb-6">Isi data berikut untuk membuat akun admin</p>

                    <form action="/register" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @csrf

                        <div>
                            <label class="block text-sm font-medium text-zinc-300 mb-1.5">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                   class="w-full bg-zinc-800 border border-zinc-700 rounded-xl px-4 py-2.5 text-white
                                          focus:outline-none focus:border-red-600 focus:ring-2 focus:ring-red-600/30
                                          placeholder-zinc-500 transition"
                                   placeholder="Nama lengkap" required>
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-zinc-300 mb-1.5">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}"
                                   class="w-full bg-zinc-800 border border-zinc-700 rounded-xl px-4 py-2.5 text-white
                                          focus:outline-none focus:border-red-600 focus:ring-2 focus:ring-red-600/30
                                          placeholder-zinc-500 transition"
                                   placeholder="admin@bookstore.com" required>
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-zinc-300 mb-1.5">No. Telepon</label>
                            <input type="text" name="phone" value="{{ old('phone') }}"
                                   class="w-full bg-zinc-800 border border-zinc-700 rounded-xl px-4 py-2.5 text-white
                                          focus:outline-none focus:border-red-600 focus:ring-2 focus:ring-red-600/30
                                          placeholder-zinc-500 transition"
                                   placeholder="08xxxxxxxxxx">
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-zinc-300 mb-1.5">Alamat</label>
                            <textarea name="address" rows="2"
                                      class="w-full bg-zinc-800 border border-zinc-700 rounded-xl px-4 py-2.5 text-white
                                             focus:outline-none focus:border-red-600 focus:ring-2 focus:ring-red-600/30
                                             placeholder-zinc-500 transition resize-none"
                                      placeholder="Alamat lengkap">{{ old('address') }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-zinc-300 mb-1.5">Password</label>
                            <input type="password" name="password"
                                   class="w-full bg-zinc-800 border border-zinc-700 rounded-xl px-4 py-2.5 text-white
                                          focus:outline-none focus:border-red-600 focus:ring-2 focus:ring-red-600/30
                                          placeholder-zinc-500 transition"
                                   placeholder="Minimal 6 karakter" required>
                            @error('password')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-zinc-300 mb-1.5">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation"
                                   class="w-full bg-zinc-800 border border-zinc-700 rounded-xl px-4 py-2.5 text-white
                                          focus:outline-none focus:border-red-600 focus:ring-2 focus:ring-red-600/30
                                          placeholder-zinc-500 transition"
                                   placeholder="Ulangi password" required>
                        </div>

                        <div class="md:col-span-2 mt-2">
                            <button type="submit"
                                    class="w-full bg-red-600 hover:bg-red-700 active:bg-red-800 
                                           text-white font-semibold py-3.5 rounded-xl text-lg
                                           transition-all duration-200 shadow-lg shadow-red-600/40">
                                Daftar Sekarang
                            </button>
                        </div>
                    </form>

                    <p class="text-center text-zinc-400 mt-6 text-sm">
                        Sudah punya akun? 
                        <a href="/login" class="text-red-500 hover:text-red-400 font-medium">Login di sini</a>
                    </p>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection