<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /** Tampilkan semua buku */
    public function index()
    {
        $books = Book::with('category')->latest()->paginate(10);
        return view('admin.books.index', compact('books'));
    }

    /** Tampilkan form tambah buku */
    public function create()
    {
        $categories = Category::all();
        return view('admin.books.create', compact('categories'));
    }

    /** Simpan buku baru */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title'       => 'required|string|max:255',
            'author'      => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Upload gambar jika ada
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('books', 'public');
        }

        Book::create([
            'category_id' => $request->category_id,
            'title'       => $request->title,
            'author'      => $request->author,
            'description' => $request->description,
            'price'       => $request->price,
            'stock'       => $request->stock,
            'image'       => $imagePath,
        ]);

        return redirect()->route('admin.books.index')
                         ->with('success', 'Buku berhasil ditambahkan!');
    }

    /** Tampilkan form edit buku */
    public function edit($id)
    {
        $book       = Book::findOrFail($id);
        $categories = Category::all();
        return view('admin.books.edit', compact('book', 'categories'));
    }

    /** Update data buku */
    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title'       => 'required|string|max:255',
            'author'      => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Upload gambar baru jika ada, hapus yang lama
        $imagePath = $book->image;
        if ($request->hasFile('image')) {
            if ($imagePath) Storage::disk('public')->delete($imagePath);
            $imagePath = $request->file('image')->store('books', 'public');
        }

        $book->update([
            'category_id' => $request->category_id,
            'title'       => $request->title,
            'author'      => $request->author,
            'description' => $request->description,
            'price'       => $request->price,
            'stock'       => $request->stock,
            'image'       => $imagePath,
        ]);

        return redirect()->route('admin.books.index')
                         ->with('success', 'Buku berhasil diperbarui!');
    }

    /** Hapus buku beserta gambarnya */
    public function destroy($id)
    {
        $book = Book::findOrFail($id);

        if ($book->image) {
            Storage::disk('public')->delete($book->image);
        }

        $book->delete();

        return redirect()->route('admin.books.index')
                         ->with('success', 'Buku berhasil dihapus!');
    }
}