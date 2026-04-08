@extends('layouts.app')
@section('title', 'Selamat Datang di BookStore')

@section('content')
{{-- Hero/Landing Section --}}
<div class="min-h-[85vh] bg-black border-b border-red-900 flex flex-col justify-center relative overflow-hidden">
    {{-- Dekorasi background (Aksen Merah) --}}
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-[20%] -right-[10%] w-[500px] h-[500px] rounded-full bg-red-600/30 blur-3xl"></div>
        <div class="absolute -bottom-[20%] -left-[10%] w-[600px] h-[600px] rounded-full bg-red-800/30 blur-3xl"></div>
        <div class="absolute top-[40%] left-[20%] w-[300px] h-[300px] rounded-full bg-red-500/10 blur-3xl"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 w-full relative z-10 text-center">
        <h1 class="text-5xl md:text-7xl font-extrabold text-white tracking-tight mb-6">
            Dunia Pengetahuan <br class="hidden md:block" /> <span class="text-red-500">di Genggamanmu.</span>
        </h1>
        <p class="text-lg md:text-xl text-gray-300 max-w-2xl mx-auto mb-10 leading-relaxed">
            Menyelami ribuan koleksi buku digital dan fisik terbaik. Temukan inspirasi barumu hari ini atau kelola perpustakaan pribadimu.
        </p>

        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="/login" class="w-full sm:w-auto px-8 py-4 bg-red-600 text-white font-bold rounded-full hover:bg-red-700 hover:scale-105 transition-all shadow-lg shadow-red-600/30">
                Mulai Jelajahi
            </a>
            <a href="/about" class="w-full sm:w-auto px-8 py-4 bg-transparent text-white font-semibold rounded-full border-2 border-white hover:bg-white hover:text-black hover:scale-105 transition-all">
                Pelajari Lebih Lanjut
            </a>
        </div>
        
        <div class="mt-16 grid grid-cols-2 md:grid-cols-4 gap-8 max-w-4xl mx-auto border-t border-red-500/30 pt-10">
            <div>
                <h4 class="text-4xl font-bold text-white mb-2">10k+</h4>
                <p class="text-red-400 text-sm font-medium">Buku Tersedia</p>
            </div>
            <div>
                <h4 class="text-4xl font-bold text-white mb-2">24/7</h4>
                <p class="text-red-400 text-sm font-medium">Akses Penuh</p>
            </div>
            <div>
                <h4 class="text-4xl font-bold text-white mb-2">5k+</h4>
                <p class="text-red-400 text-sm font-medium">Kategori</p>
            </div>
            <div>
                <h4 class="text-4xl font-bold text-white mb-2">100%</h4>
                <p class="text-red-400 text-sm font-medium">Terpercaya</p>
            </div>
        </div>
    </div>
</div>
@endsection


