@extends('layouts.app')
@section('title', 'Katalog Buku — BookStore')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-10 min-h-screen">

    <h1 class="text-4xl font-extrabold text-white mb-8 border-b-2 border-red-600 pb-4 inline-block">Katalog Buku</h1>

    {{-- Filter & Search --}}
    <form action="/books" method="GET"
          class="bg-zinc-900 border border-red-900/50 rounded-xl shadow-[0_0_15px_rgba(220,38,38,0.1)] p-5 mb-10 flex flex-col md:flex-row gap-4">

        <input type="text" name="search" value="{{ request('search') }}"
               placeholder="Cari judul atau penulis..."
               class="flex-1 bg-black text-white border border-red-800 rounded-lg px-4 py-3 text-sm
                      focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent placeholder-gray-500">

        <select name="category"
                class="bg-black text-white border border-red-800 rounded-lg px-4 py-3 text-sm
                       focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent">
            <option value="">Semua Kategori</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}"
                    {{ request('category') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        <button type="submit"
                class="bg-red-600 text-white font-bold px-8 py-3 rounded-lg text-sm
                       hover:bg-red-700 hover:shadow-lg hover:shadow-red-600/30 transition-all">
            Cari
        </button>

        @if(request('search') || request('category'))
            <a href="/books"
               class="bg-transparent border-2 border-white text-white font-bold px-8 py-3 rounded-lg text-sm
                      hover:bg-zinc-950 border border-red-900/50 hover:text-black transition-all flex items-center justify-center">
                Reset
            </a>
        @endif
    </form>

    {{-- Grid Buku --}}
    @if($books->count() > 0)
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @foreach($books as $book)
            <a href="/books/{{ $book->id }}"
               class="bg-zinc-900 border border-red-900/30 rounded-xl shadow-lg hover:shadow-red-600/20 hover:-translate-y-2
                      transition-all overflow-hidden group flex flex-col">
                <div class="overflow-hidden h-64 relative">
                    <img src="{{ $book->image ? Storage::url($book->image) : 'https://images.unsplash.com/photo-1543002588-bfa74002ed7e?w=300' }}"
                         alt="{{ $book->title }}"
                         class="w-full h-full object-cover group-hover:scale-110 group-hover:opacity-80 transition-all duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
                </div>
                <div class="p-5 flex flex-col flex-1 relative -mt-6">
                    <span class="text-xs text-white font-bold bg-red-600 px-3 py-1 rounded-full w-max shadow-lg mb-3">
                        {{ $book->category->name }}
                    </span>
                    <h3 class="font-bold text-white text-lg line-clamp-2 leading-tight">
                        {{ $book->title }}
                    </h3>
                    <p class="text-sm text-gray-400 mt-1 mb-4 flex-1">{{ $book->author }}</p>
                    <div class="flex items-end justify-between mt-auto">
                        <p class="text-red-500 font-extrabold text-lg">
                            Rp {{ number_format($book->price, 0, ',', '.') }}
                        </p>
                        <span class="text-xs text-red-500 font-medium">Stok: {{ $book->stock }}</span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-12">
            {{ $books->withQueryString()->links() }}
        </div>

    @else
        <div class="text-center py-20">
            <p class="text-5xl mb-4">📚</p>
            <p class="text-red-500">Buku tidak ditemukan</p>
            <a href="/books" class="text-white font-bold text-sm hover:underline mt-2 inline-block">
                Lihat semua buku
            </a>
        </div>
    @endif

</div>
@endsection


