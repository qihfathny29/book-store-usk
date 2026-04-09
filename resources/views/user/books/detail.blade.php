@extends('layouts.user')
@section('title', $book->title . ' — BookStore')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-10">

    {{-- Breadcrumb --}}
    <nav class="text-sm text-red-500 mb-6">
        <a href="/" class="hover:text-white font-bold">Home</a> /
        <a href="/user/books" class="hover:text-white font-bold">Buku</a> /
        <span class="text-white">{{ $book->title }}</span>
    </nav>

    {{-- Detail Buku --}}
    <div class="bg-zinc-950 border border-red-900/50 rounded-2xl shadow p-6 md:p-10 flex flex-col md:flex-row gap-10 mb-10">

        {{-- Gambar --}}
        <div class="flex-shrink-0">
            <img src="{{ $book->image ? Storage::url($book->image) : 'https://images.unsplash.com/photo-1543002588-bfa74002ed7e?w=400' }}"
                 alt="{{ $book->title }}"
                 class="w-full md:w-64 h-80 object-cover rounded-xl shadow">
        </div>

        {{-- Info --}}
        <div class="flex-1">
            <span class="text-xs text-white font-bold font-medium bg-zinc-900 border border-zinc-700 px-3 py-1 rounded-full">
    {{ $book->category->name }}
</span>
            <h1 class="text-3xl font-bold text-white mt-3 mb-1">{{ $book->title }}</h1>
            <p class="text-red-500 mb-4">oleh <span class="font-medium">{{ $book->author }}</span></p>

            <p class="text-3xl font-bold text-white font-bold mb-2">
                Rp {{ number_format($book->price, 0, ',', '.') }}
            </p>

            <p class="text-sm text-red-500 mb-6">
                Stok tersedia:
                <span class="{{ $book->stock > 0 ? 'text-green-600' : 'text-red-500' }} font-medium">
                    {{ $book->stock > 0 ? $book->stock . ' buku' : 'Habis' }}
                </span>
            </p>

            <p class="text-gray-400 leading-relaxed mb-8">{{ $book->description }}</p>

            {{-- Tombol Add to Cart --}}
{{-- Tombol Add to Cart --}}
@if($book->stock > 0)
    @if(session('user') && session('user')['role'] === 'user')
        <form action="/cart" method="POST" class="flex items-center gap-3">
            @csrf
            <input type="hidden" name="book_id" value="{{ $book->id }}">
            <input type="number" name="quantity" value="1" min="1"
                   max="{{ $book->stock }}"
                   class="w-20 bg-black border border-zinc-700 text-white rounded-lg px-4 py-3 text-center text-sm
                          focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-red-600">
            <button type="submit"
                    class="bg-red-600 hover:bg-red-700 font-bold text-white px-8 py-3 rounded-lg font-semibold transition flex items-center gap-2">
                🛒 Tambah ke Keranjang
            </button>
        </form>
    @elseif(!session('user'))
        <a href="/login" 
           class="inline-block bg-red-600 hover:bg-red-700 font-bold text-white px-8 py-3 rounded-lg font-semibold transition">
            Login untuk Membeli
        </a>
    @endif
@else
    <button disabled class="bg-gray-800 text-gray-500 px-8 py-3 rounded-lg font-semibold cursor-not-allowed">
        Stok Habis
    </button>
@endif
        </div>
    </div>

    {{-- Buku Terkait --}}
    @if($relatedBooks->count() > 0)
    <div>
        <h2 class="text-xl font-bold text-white mb-4">Buku Terkait</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @foreach($relatedBooks as $related)
            <a href="/user/books/{{ $related->id }}"
               class="bg-zinc-950 border border-red-900/50 rounded-xl shadow hover:shadow-md hover:-translate-y-1
                      transition-all overflow-hidden">
                <img src="{{ $related->image ? Storage::url($related->image) : 'https://images.unsplash.com/photo-1543002588-bfa74002ed7e?w=300' }}"
                     alt="{{ $related->title }}"
                     class="w-full h-40 object-cover">
                <div class="p-3">
                    <h3 class="font-semibold text-white text-sm line-clamp-2">{{ $related->title }}</h3>
                    <p class="text-white font-bold font-bold text-sm mt-1">
                        Rp {{ number_format($related->price, 0, ',', '.') }}
                    </p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif

</div>
@endsection
