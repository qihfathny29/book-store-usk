<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /** Tampilkan halaman form contact */
    public function index()
    {
        return view('contact');
    }

    /** Proses pengiriman pesan dari user ke admin */
    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'message' => 'required|string',
        ]);

        Message::create([
            'user_id' => session('user')['id'] ?? null,
            'name'    => $request->name,
            'email'   => $request->email,
            'message' => $request->message,
        ]);

        return back()->with('success', 'Pesan berhasil dikirim! Admin akan segera merespons.');
    }
}