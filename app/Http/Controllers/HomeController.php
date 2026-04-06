<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;

class HomeController extends Controller
{
    /** Tampilkan halaman utama dengan buku terbaru */
    public function index()
    {
        $books      = Book::with('category')->latest()->take(8)->get();
        $categories = Category::all();

        return view('home', compact('books', 'categories'));
    }

    /** Tampilkan halaman about us */
    public function about()
    {
        return view('about');
    }
}