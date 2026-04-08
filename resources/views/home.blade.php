@extends('layouts.user')
@section('title', 'Home — BookStore')

@section('content')

{{-- Hero Section --}}
<section class="text-white py-20">
    <div class="max-w-7xl mx-auto px-4 flex flex-col md:flex-row items-center gap-10">
        <div class="flex-1">
            <h1 class="text-4xl md:text-5xl font-bold leading-tight mb-4">
                Temukan Buku <br> Favoritmu Disini 📚
            </h1>
            <p class="text-indigo-100 text-lg mb-8">
                Koleksi buku terlengkap dengan harga terbaik. Pesan sekarang, bayar saat terima!
            </p>
            <a href="/books"
               class="bg-zinc-950 border border-red-900/50 text-red-500 font-semibold px-8 py-3 rounded-full hover:bg-red-950/30 transition">
                Lihat Koleksi Buku
            </a>
        </div>
        <div class="flex-1 flex justify-center">
            <img src="https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?w=500"
                 alt="Books" class="rounded-2xl shadow-2xl w-full max-w-md object-cover">
        </div>
    </div>
</section>

{{-- Kategori --}}
<section class="max-w-7xl mx-auto px-4 py-12">
    <h2 class="text-2xl font-bold text-gray-100 mb-6">Kategori Buku</h2>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        @foreach($categories as $category)
        <a href="/books?category={{ $category->id }}"
           class="bg-zinc-950 border border-red-900/50 rounded-xl p-4 text-center shadow hover:shadow-md hover:-translate-y-1
                  transition-all border border-gray-100">
            <p class="font-semibold text-gray-700">{{ $category->name }}</p>
        </a>
        @endforeach
    </div>
</section>

{{-- Buku Terbaru --}}
<section class="max-w-7xl mx-auto px-4 pb-16">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-100">Buku Terbaru</h2>
        <a href="/books" class="text-red-500 hover:underline text-sm">Lihat semua →</a>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
        @foreach($books as $book)
        <a href="/books/{{ $book->id }}"
           class="bg-zinc-950 border border-red-900/50 rounded-xl shadow hover:shadow-md hover:-translate-y-1 transition-all overflow-hidden">
            <img src="{{ $book->image ? Storage::url($book->image) : 'https://images.unsplash.com/photo-1543002588-bfa74002ed7e?w=300' }}"
                 alt="{{ $book->title }}"
                 class="w-full h-48 object-cover">
            <div class="p-4">
                <p class="text-xs text-red-500 font-medium mb-1">{{ $book->category->name }}</p>
                <h3 class="font-semibold text-gray-100 text-sm line-clamp-2">{{ $book->title }}</h3>
                <p class="text-xs text-gray-400 mt-1">{{ $book->author }}</p>
                <p class="text-red-500 font-bold mt-2">
                    Rp {{ number_format($book->price, 0, ',', '.') }}
                </p>
            </div>
        </a>
        @endforeach
    </div>
</section>

@endsection
