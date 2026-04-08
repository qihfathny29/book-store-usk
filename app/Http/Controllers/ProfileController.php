<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /** Tampilkan halaman profil user */
    public function index()
    {
        $userId = session('user')['id'];
        $user = User::findOrFail($userId);
        
        return view('profile.index', compact('user'));
    }

    /** Proses update profil ke dalam database */
    public function update(Request $request)
    {
        $userId = session('user')['id'];
        $user = User::findOrFail($userId);

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->address = $request->address;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        // Update data session user dengan data yang baru
        $sessionUser = session('user');
        $sessionUser['name'] = $user->name;
        $sessionUser['phone'] = $user->phone;
        $sessionUser['address'] = $user->address;
        session(['user' => $sessionUser]);

        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}