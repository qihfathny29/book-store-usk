@extends('layouts.admin')
@section('title', 'Kategori')

@section('content')
<div class="flex justify-between items-center mb-8">
    <div class="flex items-center gap-3 border-b-2 border-red-600 pb-2 inline-flex">
        <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
        <h1 class="text-3xl font-extrabold text-white">Kategori Buku</h1>
    </div>
    <a href="/admin/categories/create"
       class="bg-red-600 text-white px-6 py-2.5 rounded-lg text-sm font-bold shadow-lg shadow-red-600/30 hover:-translate-y-0.5 hover:shadow-red-600/50 hover:bg-red-700 transition-all flex items-center gap-2">
        <span class="text-lg">+</span> Tambah Kategori
    </a>
</div>

<div class="bg-zinc-900 border border-red-900/50 rounded-xl shadow-[0_0_15px_rgba(220,38,38,0.1)] overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="bg-black text-red-500 uppercase text-xs font-bold border-b border-red-900/50">
                <tr>
                    <th class="px-6 py-4">#</th>
                    <th class="px-6 py-4">Nama Kategori</th>
                    <th class="px-6 py-4">Slug</th>
                    <th class="px-6 py-4">Jumlah Buku</th>
                    <th class="px-6 py-4">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-red-900/30">
                @forelse($categories as $category)
                <tr class="hover:bg-zinc-800 transition-colors">
                    <td class="px-6 py-4 text-gray-500">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4 font-bold text-white">{{ $category->name }}</td>
                    <td class="px-6 py-4 text-gray-400">{{ $category->slug }}</td>
                    <td class="px-6 py-4 text-gray-400 font-semibold">{{ $category->books_count }} <span class="font-normal text-gray-500">buku</span></td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-2">
                            <a href="/admin/categories/{{ $category->id }}/edit"
                               class="bg-zinc-800 text-white border border-gray-600 hover:border-white hover:bg-gray-700 px-4 py-1.5 rounded-lg text-xs font-bold transition-all">
                                Edit
                            </a>
                            <form action="/admin/categories/{{ $category->id }}" method="POST"
                                  onsubmit="return confirm('Yakin hapus kategori ini?')">
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
                    <td colspan="5" class="px-6 py-10 text-center text-gray-500 bg-black">
                        Belum ada kategori
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-6 py-4 bg-black border-t border-red-900/50">{{ $categories->links() }}</div>
</div>
@endsection
