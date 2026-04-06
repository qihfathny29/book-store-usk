<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /** Tampilkan semua kategori */
    public function index()
    {
        $categories = Category::withCount('books')->latest()->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    /** Tampilkan form tambah kategori */
    public function create()
    {
        return view('admin.categories.create');
    }

    /** Simpan kategori baru */
    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255|unique:categories,name']);

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('admin.categories.index')
                         ->with('success', 'Kategori berhasil ditambahkan!');
    }

    /** Tampilkan form edit kategori */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    /** Update data kategori */
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $id
        ]);

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('admin.categories.index')
                         ->with('success', 'Kategori berhasil diperbarui!');
    }

    /** Hapus kategori */
    public function destroy($id)
    {
        Category::findOrFail($id)->delete();

        return redirect()->route('admin.categories.index')
                         ->with('success', 'Kategori berhasil dihapus!');
    }
}