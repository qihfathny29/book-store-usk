# Panduan Implementasi: BookStore App - STEP 11 (Logika Autentikasi & Setup Layout Views)

Di **STEP 11** ini, kita akan fokus menyelesaikan pondasi sistem keamanan yaitu **Logika Login & Register secara Custom (Manual)** dan menyiapkan **Kerangka Tampilan (Layout Templates)** menggunakan Blade.

---

## 1. IMPLEMENTASI LOGIKA `AuthController`

Silakan buka file `app/Http/Controllers/AuthController.php` dan buat struktur kodenya seperti di bawah ini. Kode ini mengurus proses Validasi, Register, Login, Pemisahan Aktor (Admin/User), dan Logout.

```php
<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Menampilkan halaman Register
    public function showRegister()
    {
        return view('auth.register');
    }

    // Memproses form Register
    public function register(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed', // butuh password_confirmation di form
        ]);

        // 2. Simpan ke database (Secara default role adalah 'user' berdasarkan migration)
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // 3. Langsung login setelah register
        Auth::login($user);

        // 4. Redirect ke home
        return redirect()->route('home')->with('success', 'Registrasi berhasil! Selamat datang.');
    }

    // Menampilkan halaman Login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Memproses form Login
    public function login(Request $request)
    {
        // 1. Validasi input
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        // 2. Cek kredensial
        if (Auth::attempt($credentials)) {
            // Regenerasi session untuk keamanan
            $request->session()->regenerate();

            // 3. Cek Role, arahkan ke dashboard Admin atau Home (User)
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('home')->with('success', 'Login berhasil!');
        }

        // 4. Jika gagal, kembalikan ke form dengan pesan error
        return back()->withErrors([
            'email' => 'Email atau Password salah.',
        ])->onlyInput('email');
    }

    // Memproses Logout
    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Anda telah berhasil logout.');
    }
}
```

---

## 2. SETUP STRUKTUR FOLDER VIEWS (BLADE)

Karena kita punya 2 aktor (Admin & User) yang halamannya berbeda total, praktik terbaik (*best practice*) adalah memisahkan layout induk (*master layout*).

Buatlah folder dan file kosong ini di dalam folder `resources/views/`:

```text
resources/
└── views/
    ├── auth/
    │   ├── login.blade.php
    │   └── register.blade.php
    ├── layouts/
    │   ├── admin.blade.php  (Layout khusus untuk halaman dashboard Admin)
    │   └── app.blade.php    (Layout utama untuk halaman public & pembeli)
    ├── admin/
    │   ├── dashboard.blade.php
    │   └── (Nanti buat folder books/, categories/, dll di sini)
    └── pages/
        ├── home.blade.php
        ├── about.blade.php
        └── contact.blade.php
```

---

## 3. ISI FILE AUTH VIEWS (LOGIN & REGISTER)

Karena di workspace Anda sudah ada Tailwind CSS (terlihat dari `tailwind.config.js`), Anda bisa mendesain halaman `auth/login.blade.php` dan `auth/register.blade.php`.

**Contoh sangat sederhana untuk `auth/login.blade.php`:**

```html
<!-- Nanti silakan dipercantik menggunakan Tailwind CSS -->
<form action="{{ route('login.post') }}" method="POST">
    @csrf
    <div>
        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}" required>
        @error('email') <span>{{ $message }}</span> @enderror
    </div>
    
    <div>
        <label>Password</label>
        <input type="password" name="password" required>
    </div>
    
    <button type="submit">Login</button>
</form>
```

*(Lakukan hal yang sama untuk `auth/register.blade.php`, jangan lupa tambahkan input `password_confirmation` karena kita menggunakan rule validasi `confirmed` di controller).*

---

### Langkah Anda Selanjutnya:
1. Copy-paste kode ke dalam `app/Http/Controllers/AuthController.php`.
2. Buat folder dan file views kosong sesuai struktur di atas.
3. Desain form Login dan Register sesuai kreasi UI/UX Anda (Bisa ambil referensi template desain gratis yang non-hak-cipta).
4. Coba tes fitur Registrasi dan Login di browser.

Jika Registrasi dan Login sudah berjalan (*bisa masuk ke halaman home atau admin dashboard tanpa error*), kabari saya untuk kita lanjut ke pembuatan fungsionalitas utama (*CRUD Kategori/Buku atau Fitur Frontend Store*).
