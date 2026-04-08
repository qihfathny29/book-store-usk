<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /** Tampilkan halaman form register */
    public function showRegister()
    {
        return view('auth.register');
    }

    /** Proses registrasi user baru */
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'phone'    => 'nullable|string|max:20',
            'address'  => 'nullable|string',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'user',
            'phone'    => $request->phone,
            'address'  => $request->address,
        ]);

        return redirect('/login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    /** Tampilkan halaman form login */
    public function showLogin()
    {
        return view('auth.login');
    }

    /** Proses login user */
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        // Cek apakah user ada dan password cocok
        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Email atau password salah!');
        }

        // Simpan data user ke session
        session(['user' => $user->toArray()]);

        // Redirect berdasarkan role
        if ($user->role === 'admin') {
            return redirect('/admin/dashboard');
        }

        return redirect('/home')->with('success', 'Selamat datang, ' . $user->name . '!');
    }

    /** Proses logout user */
    public function logout()
    {
        session()->forget('user');
        return redirect('/login')->with('success', 'Berhasil logout!');
    }
}