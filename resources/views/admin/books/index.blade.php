@extends('layouts.admin')
@section('title', 'Kelola Buku')

@section('content')
<div class="flex justify-between items-center mb-8">
    <div class="flex items-center gap-3 border-b-2 border-red-600 pb-2 inline-flex">
        <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
        <h1 class="text-3xl font-extrabold text-white">Kelola Buku</h1>
    </div>
    <a href="/admin/books/create"
       class="bg-red-600 text-white px-6 py-2.5 rounded-lg text-sm font-bold shadow-lg shadow-red-600/30 hover:-translate-y-0.5 hover:shadow-red-600/50 hover:bg-red-700 transition-all flex items-center gap-2">
        <span class="text-lg">+</span> Tambah Buku
    </a>
</div>

<div class="bg-zinc-900 border border-red-900/50 rounded-xl shadow-[0_0_15px_rgba(220,38,38,0.1)] overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="bg-black text-red-500 uppercase text-xs font-bold border-b border-red-900/50">
                <tr>
                    <th class="px-6 py-4">#</th>
                    <th class="px-6 py-4">Cover</th>
                    <th class="px-6 py-4">Judul</th>
                    <th class="px-6 py-4">Kategori</th>
                    <th class="px-6 py-4">Harga</th>
                    <th class="px-6 py-4">Stok</th>
                    <th class="px-6 py-4">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-red-900/30">
                @forelse($books as $book)
                <tr class="hover:bg-zinc-800 transition-colors">
                    <td class="px-6 py-4 text-gray-500">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4">
                        <img src="{{ $book->image ? Storage::url($book->image) : 'https://images.unsplash.com/photo-1543002588-bfa74002ed7e?w=100' }}"
                             class="w-10 h-12 object-cover rounded border border-red-900/50">
                    </td>
                    <td class="px-6 py-4">
                        <p class="font-bold text-white">{{ $book->title }}</p>
                        <p class="text-gray-400 text-xs">{{ $book->author }}</p>
                    </td>
                    <td class="px-6 py-4 text-gray-400">
                        <span class="bg-black border border-red-900/30 px-2 py-1 rounded text-xs">{{ $book->category->name }}</span>
                    </td>
                    <td class="px-6 py-4 font-bold text-red-500">
                        Rp {{ number_format($book->price, 0, ',', '.') }}
                    </td>
                    <td class="px-6 py-4">
                        <span class="{{ $book->stock > 0 ? 'text-green-500' : 'text-red-500' }} font-bold bg-black px-2 py-1 rounded-lg border {{ $book->stock > 0 ? 'border-green-900/30' : 'border-red-900/30' }}">
                            {{ $book->stock }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-2">
                            <a href="/admin/books/{{ $book->id }}/edit"
                               class="bg-zinc-800 text-white border border-gray-600 hover:border-white hover:bg-gray-700 px-4 py-1.5 rounded-lg text-xs font-bold transition-all">
                                Edit
                            </a>
                            <form action="/admin/books/{{ $book->id }}" method="POST" class="m-0 p-0 flex items-center"
                                  onsubmit="return confirm('Yakin hapus buku ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="bg-red-900/20 text-red-500 border border-red-900/50 hover:bg-red-600 hover:text-white px-4 py-1.5 rounded-lg text-xs font-bold transition-all">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-10 text-center text-gray-500 bg-black">Belum ada buku</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-6 py-4 bg-black border-t border-red-900/50">{{ $books->links() }}</div>
</div>
@endsection
