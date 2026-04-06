@extends('layouts.app')
@section('title', 'Katalog Buku — BookStore')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-10">

    <h1 class="text-3xl font-bold text-gray-800 mb-8">Katalog Buku</h1>

    {{-- Filter & Search --}}
    <form action="/books" method="GET"
          class="bg-white rounded-xl shadow p-4 mb-8 flex flex-col md:flex-row gap-3">

        <input type="text" name="search" value="{{ request('search') }}"
               placeholder="Cari judul atau penulis..."
               class="flex-1 border border-gray-300 rounded-lg px-4 py-2 text-sm
                      focus:outline-none focus:ring-2 focus:ring-indigo-500">

        <select name="category"
                class="border border-gray-300 rounded-lg px-4 py-2 text-sm
                       focus:outline-none focus:ring-2 focus:ring-indigo-500">
            <option value="">Semua Kategori</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}"
                    {{ request('category') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        <button type="submit"
                class="bg-indigo-600 text-white px-6 py-2 rounded-lg text-sm
                       hover:bg-indigo-700 transition">
            Cari
        </button>

        @if(request('search') || request('category'))
            <a href="/books"
               class="bg-gray-100 text-gray-600 px-6 py-2 rounded-lg text-sm
                      hover:bg-gray-200 transition text-center">
                Reset
            </a>
        @endif
    </form>

    {{-- Grid Buku --}}
    @if($books->count() > 0)
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($books as $book)
            <a href="/books/{{ $book->id }}"
               class="bg-white rounded-xl shadow hover:shadow-md hover:-translate-y-1
                      transition-all overflow-hidden group">
                <div class="overflow-hidden h-52">
                    <img src="{{ $book->image ? Storage::url($book->image) : 'https://images.unsplash.com/photo-1543002588-bfa74002ed7e?w=300' }}"
                         alt="{{ $book->title }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                </div>
                <div class="p-4">
                    <span class="text-xs text-indigo-600 font-medium bg-indigo-50 px-2 py-1 rounded-full">
                        {{ $book->category->name }}
                    </span>
                    <h3 class="font-semibold text-gray-800 text-sm mt-2 line-clamp-2">
                        {{ $book->title }}
                    </h3>
                    <p class="text-xs text-gray-500 mt-1">{{ $book->author }}</p>
                    <div class="flex items-center justify-between mt-3">
                        <p class="text-indigo-600 font-bold text-sm">
                            Rp {{ number_format($book->price, 0, ',', '.') }}
                        </p>
                        <span class="text-xs text-gray-400">Stok: {{ $book->stock }}</span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-8">
            {{ $books->withQueryString()->links() }}
        </div>

    @else
        <div class="text-center py-20">
            <p class="text-5xl mb-4">📚</p>
            <p class="text-gray-500">Buku tidak ditemukan</p>
            <a href="/books" class="text-indigo-600 text-sm hover:underline mt-2 inline-block">
                Lihat semua buku
            </a>
        </div>
    @endif

</div>
@endsection