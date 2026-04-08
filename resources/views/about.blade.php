@extends('layouts.app')
@section('title', 'About Us — BookStore')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-16 min-h-[80vh]">

    <div class="text-center mb-12 relative">
        <h1 class="text-5xl font-extrabold text-white mb-4 relative z-10">Tentang Kami</h1>
        <p class="text-gray-400 text-lg relative z-10">Kenali lebih dekat BookStore dan misi kami</p>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[200px] h-[100px] bg-red-600/20 blur-3xl pointer-events-none"></div>
    </div>

    <div class="grid md:grid-cols-2 gap-10 items-center mb-20 bg-zinc-950 p-8 rounded-3xl border border-red-900/40 shadow-xl shadow-black">
        <div class="relative group overflow-hidden rounded-2xl">
            <div class="absolute inset-0 bg-red-600/20 group-hover:bg-transparent transition-all z-10"></div>
            <img src="https://images.unsplash.com/photo-1507842217343-583bb7270b66?w=600"
                 alt="About" class="w-full object-cover h-80 group-hover:scale-105 transition-all duration-700">
        </div>
        <div>
            <h2 class="text-3xl font-bold text-white mb-4 flex items-center gap-3">
                <span class="w-8 h-1 bg-red-600 inline-block"></span> Siapa Kami?
            </h2>
            <p class="text-gray-400 leading-relaxed mb-4">
                <span class="text-red-500 font-bold">BookStore</span> adalah toko buku online yang didirikan dengan semangat menyebarkan
                ilmu pengetahuan dan budaya membaca di seluruh Indonesia.
            </p>
            <p class="text-gray-400 leading-relaxed">
                Kami menyediakan ribuan judul buku dari berbagai kategori dengan harga terjangkau
                dan sistem pembayaran yang mudah — <span class="text-white">bayar saat buku tiba di tanganmu!</span>
            </p>
        </div>
    </div>

    {{-- Values --}}
    <div class="grid md:grid-cols-3 gap-6 mb-16">
        <div class="bg-black border border-red-900/50 hover:border-red-500 rounded-2xl p-8 text-center transition-all hover:-translate-y-2 hover:shadow-lg hover:shadow-red-600/20 group">
            <div class="w-16 h-16 bg-red-950 text-red-500 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:bg-red-600 group-hover:text-white transition-all">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
            </div>
            <h3 class="text-xl font-bold text-white mb-2">Koleksi Lengkap</h3>
            <p class="text-sm text-gray-400">Dari fiksi, komputer, hingga buku pelajaran, semua ada di sini.</p>
        </div>

        <div class="bg-black border border-red-900/50 hover:border-red-500 rounded-2xl p-8 text-center transition-all hover:-translate-y-2 hover:shadow-lg hover:shadow-red-600/20 group">
            <div class="w-16 h-16 bg-red-950 text-red-500 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:bg-red-600 group-hover:text-white transition-all">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
            <h3 class="text-xl font-bold text-white mb-2">Harga Terbaik</h3>
            <p class="text-sm text-gray-400">Dapatkan harga yang lebih murah dibandingkan toko buku konvensional.</p>
        </div>

        <div class="bg-black border border-red-900/50 hover:border-red-500 rounded-2xl p-8 text-center transition-all hover:-translate-y-2 hover:shadow-lg hover:shadow-red-600/20 group">
            <div class="w-16 h-16 bg-red-950 text-red-500 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:bg-red-600 group-hover:text-white transition-all">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path></svg>
            </div>
            <h3 class="text-xl font-bold text-white mb-2">Aman & Nyaman</h3>
            <p class="text-sm text-gray-400">Pesan buku dengan mudah dan tunggu barang tiba dengan aman.</p>
        </div>
    </div>
</div>
@endsection

