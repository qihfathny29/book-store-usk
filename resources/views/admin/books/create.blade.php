@extends('layouts.admin')
@section('title', 'Tambah Buku')

@section('content')
<div class="max-w-2xl">
    <div class="flex items-center gap-4 mb-6">
        <a href="/admin/books" class="text-red-500 hover:underline text-sm">← Kembali</a>
        <h1 class="text-2xl font-bold text-white">Tambah Buku</h1>
    </div>

    <div class="bg-zinc-900 border border-red-900/50 rounded-xl shadow p-6">
        <form action="/admin/books" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div class="grid grid-cols-2 gap-4">
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-300 mb-1">Judul Buku</label>
                    <input type="text" name="title" value="{{ old('title') }}"
                           class="w-full bg-zinc-800 border border-red-900/50 rounded-lg px-4 py-2 text-sm text-gray-100
                                  focus:outline-none focus:ring-2 focus:ring-red-600" required>
                    @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1">Penulis</label>
                    <input type="text" name="author" value="{{ old('author') }}"
                           class="w-full bg-zinc-800 border border-red-900/50 rounded-lg px-4 py-2 text-sm text-gray-100
                                  focus:outline-none focus:ring-2 focus:ring-red-600" required>
                    @error('author') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1">Kategori</label>
                    <select name="category_id"
                            class="w-full bg-zinc-800 border border-red-900/50 rounded-lg px-4 py-2 text-sm text-gray-100
                                   focus:outline-none focus:ring-2 focus:ring-red-600" required>
                        <option value="" class="bg-zinc-800">Pilih Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" class="bg-zinc-800"
                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1">Harga (Rp)</label>
                    <input type="number" name="price" value="{{ old('price') }}" min="0"
                           class="w-full bg-zinc-800 border border-red-900/50 rounded-lg px-4 py-2 text-sm text-gray-100
                                  focus:outline-none focus:ring-2 focus:ring-red-600" required>
                    @error('price') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1">Stok</label>
                    <input type="number" name="stock" value="{{ old('stock', 0) }}" min="0"
                           class="w-full bg-zinc-800 border border-red-900/50 rounded-lg px-4 py-2 text-sm text-gray-100
                                  focus:outline-none focus:ring-2 focus:ring-red-600" required>
                    @error('stock') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-300 mb-1">Deskripsi</label>
                    <textarea name="description" rows="4"
                              class="w-full bg-zinc-800 border border-red-900/50 rounded-lg px-4 py-2 text-sm text-gray-100
                                     focus:outline-none focus:ring-2 focus:ring-red-600">{{ old('description') }}</textarea>
                </div>

                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-300 mb-1">Cover Buku</label>
                    <input type="file" name="image" accept="image/*"
                           class="w-full bg-zinc-800 border border-red-900/50 rounded-lg px-4 py-2 text-sm text-gray-400
                                  focus:outline-none focus:ring-2 focus:ring-red-600
                                  file:bg-zinc-700 file:border file:border-red-900/50 file:rounded-md
                                  file:px-3 file:py-1 file:text-sm file:text-gray-200 file:mr-3 file:cursor-pointer">
                    @error('image') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <button type="submit"
                    class="w-full bg-red-600 text-white font-semibold py-2 rounded-lg hover:bg-red-700 transition">
                Simpan Buku
            </button>
        </form>
    </div>
</div>
@endsection