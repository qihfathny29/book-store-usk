<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /** Tampilkan semua buku dengan fitur pencarian & filter kategori */
    public function index(Request $request)
    {
        $query = Book::with('category');

        // Filter berdasarkan keyword pencarian
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('author', 'like', '%' . $request->search . '%');
        }

        // Filter berdasarkan kategori
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $books      = $query->latest()->paginate(12);
        $categories = Category::all();

        return view('books.index', compact('books', 'categories'));
    }

    /** Tampilkan detail satu buku */
    public function show($id)
    {
        $book          = Book::with('category')->findOrFail($id);
        $relatedBooks  = Book::where('category_id', $book->category_id)
                             ->where('id', '!=', $id)
                             ->take(4)
                             ->get();

        return view('books.show', compact('book', 'relatedBooks'));
    }
}