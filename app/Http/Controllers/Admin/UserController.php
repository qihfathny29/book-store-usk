<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    /** Tampilkan semua user yang terdaftar */
    public function index()
    {
        $users = User::where('role', 'user')->latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }
}