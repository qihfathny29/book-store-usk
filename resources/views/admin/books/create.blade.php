@extends('layouts.admin')
@section('title', 'Tambah Buku')

@section('content')
<div class="max-w-2xl">
    <div class="flex items-center gap-4 mb-6">
        <a href="/admin/books" class="text-indigo-600 hover:underline text-sm">← Kembali</a>
        <h1 class="text-2xl font-bold text-gray-800">Tambah Buku</h1>
    </div>

    <div class="bg-white rounded-xl shadow p-6">
        <form action="/admin/books" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div class="grid grid-cols-2 gap-4">
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Judul Buku</label>
                    <input type="text" name="title" value="{{ old('title') }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm
                                  focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                    @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Penulis</label>
                    <input type="text" name="author" value="{{ old('author') }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm
                                  focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                    @error('author') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                    <select name="category_id"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm
                                   focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Harga (Rp)</label>
                    <input type="number" name="price" value="{{ old('price') }}" min="0"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm
                                  focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                    @error('price') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Stok</label>
                    <input type="number" name="stock" value="{{ old('stock', 0) }}" min="0"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm
                                  focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                    @error('stock') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                    <textarea name="description" rows="4"
                              class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm
                                     focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('description') }}</textarea>
                </div>

                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Cover Buku</label>
                    <input type="file" name="image" accept="image/*"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm
                                  focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    @error('image') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <button type="submit"
                    class="w-full bg-indigo-600 text-white font-semibold py-2 rounded-lg hover:bg-indigo-700 transition">
                Simpan Buku
            </button>
        </form>
    </div>
</div>
@endsection