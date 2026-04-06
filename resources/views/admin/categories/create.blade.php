@extends('layouts.admin')
@section('title', 'Tambah Kategori')

@section('content')
<div class="max-w-lg">
    <div class="flex items-center gap-4 mb-6">
        <a href="/admin/categories" class="text-indigo-600 hover:underline text-sm">← Kembali</a>
        <h1 class="text-2xl font-bold text-gray-800">Tambah Kategori</h1>
    </div>

    <div class="bg-white rounded-xl shadow p-6">
        <form action="/admin/categories" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Kategori</label>
                <input type="text" name="name" value="{{ old('name') }}"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm
                              focus:outline-none focus:ring-2 focus:ring-indigo-500"
                       placeholder="Contoh: Fiksi, Sains, Sejarah..." required>
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit"
                    class="w-full bg-indigo-600 text-white font-semibold py-2 rounded-lg hover:bg-indigo-700 transition">
                Simpan Kategori
            </button>
        </form>
    </div>
</div>
@endsection