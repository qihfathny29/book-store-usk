@extends('layouts.admin')
@section('title', 'Kelola Buku')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">📖 Kelola Buku</h1>
    <a href="/admin/books/create"
       class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-indigo-700 transition">
        + Tambah Buku
    </a>
</div>

<div class="bg-white rounded-xl shadow overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
            <tr>
                <th class="px-6 py-3 text-left">#</th>
                <th class="px-6 py-3 text-left">Cover</th>
                <th class="px-6 py-3 text-left">Judul</th>
                <th class="px-6 py-3 text-left">Kategori</th>
                <th class="px-6 py-3 text-left">Harga</th>
                <th class="px-6 py-3 text-left">Stok</th>
                <th class="px-6 py-3 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($books as $book)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 text-gray-500">{{ $loop->iteration }}</td>
                <td class="px-6 py-4">
                    <img src="{{ $book->image ? Storage::url($book->image) : 'https://images.unsplash.com/photo-1543002588-bfa74002ed7e?w=100' }}"
                         class="w-10 h-12 object-cover rounded">
                </td>
                <td class="px-6 py-4">
                    <p class="font-medium text-gray-800">{{ $book->title }}</p>
                    <p class="text-gray-500 text-xs">{{ $book->author }}</p>
                </td>
                <td class="px-6 py-4 text-gray-500">{{ $book->category->name }}</td>
                <td class="px-6 py-4 font-medium text-indigo-600">
                    Rp {{ number_format($book->price, 0, ',', '.') }}
                </td>
                <td class="px-6 py-4">
                    <span class="{{ $book->stock > 0 ? 'text-green-600' : 'text-red-500' }} font-medium">
                        {{ $book->stock }}
                    </span>
                </td>
                <td class="px-6 py-4 flex gap-2">
                    <a href="/admin/books/{{ $book->id }}/edit"
                       class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-lg text-xs hover:bg-yellow-200">
                        Edit
                    </a>
                    <form action="/admin/books/{{ $book->id }}" method="POST"
                          onsubmit="return confirm('Yakin hapus buku ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="bg-red-100 text-red-600 px-3 py-1 rounded-lg text-xs hover:bg-red-200">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="px-6 py-10 text-center text-gray-400">Belum ada buku</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="px-6 py-4">{{ $books->links() }}</div>
</div>
@endsection