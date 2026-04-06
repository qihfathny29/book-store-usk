@extends('layouts.admin')
@section('title', 'Kategori')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">🏷️ Kategori Buku</h1>
    <a href="/admin/categories/create"
       class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-indigo-700 transition">
        + Tambah Kategori
    </a>
</div>

<div class="bg-white rounded-xl shadow overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
            <tr>
                <th class="px-6 py-3 text-left">#</th>
                <th class="px-6 py-3 text-left">Nama Kategori</th>
                <th class="px-6 py-3 text-left">Slug</th>
                <th class="px-6 py-3 text-left">Jumlah Buku</th>
                <th class="px-6 py-3 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($categories as $category)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 text-gray-500">{{ $loop->iteration }}</td>
                <td class="px-6 py-4 font-medium text-gray-800">{{ $category->name }}</td>
                <td class="px-6 py-4 text-gray-500">{{ $category->slug }}</td>
                <td class="px-6 py-4 text-gray-500">{{ $category->books_count }} buku</td>
                <td class="px-6 py-4 flex gap-2">
                    <a href="/admin/categories/{{ $category->id }}/edit"
                       class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-lg text-xs hover:bg-yellow-200">
                        Edit
                    </a>
                    <form action="/admin/categories/{{ $category->id }}" method="POST"
                          onsubmit="return confirm('Yakin hapus kategori ini?')">
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
                <td colspan="5" class="px-6 py-10 text-center text-gray-400">
                    Belum ada kategori
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="px-6 py-4">{{ $categories->links() }}</div>
</div>
@endsection