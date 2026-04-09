<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /** Tampilkan semua buku dengan fitur pencarian & filter kategori (KHUSUS USER) */
    public function index(Request $request)
    {
        $query = Book::with('category');

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('author', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $books      = $query->latest()->paginate(12);
        $categories = Category::all();

        return view('user.books.index', compact('books', 'categories'));
    }

    /** Tampilkan detail satu buku (KHUSUS USER) */
    public function show($id)
    {
        $book          = Book::with('category')->findOrFail($id);
        $relatedBooks  = Book::where('category_id', $book->category_id)
                             ->where('id', '!=', $id)
                             ->take(4)
                             ->get();

        return view('user.books.detail', compact('book', 'relatedBooks'));
    }

    /** Tampilkan semua buku dengan fitur pencarian & filter kategori (PUBLIC) */
    public function publicIndex(Request $request)
    {
        $query = Book::with('category');

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('author', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $books      = $query->latest()->paginate(12);
        $categories = Category::all();

        return view('catalog.index', compact('books', 'categories'));
    }

    /** Tampilkan detail satu buku (PUBLIC) */
    public function publicShow($id)
    {
        $book          = Book::with('category')->findOrFail($id);
        $relatedBooks  = Book::where('category_id', $book->category_id)
                             ->where('id', '!=', $id)
                             ->take(4)
                             ->get();

        return view('catalog.detail', compact('book', 'relatedBooks'));
    }
}
