@extends('layouts.admin')
@section('title', 'Edit Kategori')

@section('content')
<div class="max-w-lg">
    <div class="flex items-center gap-4 mb-6">
        <a href="/admin/categories" class="text-red-500 hover:underline text-sm">â† Kembali</a>
        <h1 class="text-2xl font-bold text-white">Edit Kategori</h1>
    </div>

    <div class="bg-zinc-900 border border-red-900/50 rounded-xl shadow p-6">
        <form action="/admin/categories/{{ $category->id }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Nama Kategori</label>
                <input type="text" name="name" value="{{ old('name', $category->name) }}"
                       class="w-full border border-red-900/50 rounded-lg px-4 py-2 text-sm
                              focus:outline-none focus:ring-2 focus:ring-red-600" required>
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit"
                    class="w-full bg-red-600 text-white font-semibold py-2 rounded-lg hover:bg-red-700 transition">
                Update Kategori
            </button>
        </form>
    </div>
</div>
@endsection
