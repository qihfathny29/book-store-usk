<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;

class MessageController extends Controller
{
    /** Tampilkan semua pesan masuk */
    public function index()
    {
        $messages = Message::latest()->paginate(10);
        return view('admin.messages.index', compact('messages'));
    }

    /** Tampilkan detail pesan & tandai sudah dibaca */
    public function show($id)
    {
        $message = Message::findOrFail($id);
        $message->update(['is_read' => true]);

        return view('admin.messages.show', compact('message'));
    }
}