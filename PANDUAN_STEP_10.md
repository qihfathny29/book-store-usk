# Panduan Implementasi: BookStore App - STEP 10 (Routes & Controllers)

Aplikasi BookStore ini memiliki 2 aktor utama: **Admin** dan **User**. Anda sudah berhasil membuat fondasi Database (Migrations), Models, dan Middleware dengan sempurna. 

Berikut adalah instruksi **STEP 10** agar Anda bisa mulai mengimplementasikan *Controllers* dan *Routing*-nya.

---

## DAFTAR CONTROLLERS YANG PERLU DIBUAT

Jalankan perintah (command) berikut di terminal untuk *generate* *controllers* yang dibutuhkan:

### 1. Admin Controllers (Akses Khusus Admin)
Disarankan meletakkannya di dalam folder `Admin` agar rapi. Gunakan `--resource` untuk memudahkan CRUD:

```bash
php artisan make:controller Admin/CategoryController --resource
php artisan make:controller Admin/BookController --resource
php artisan make:controller Admin/OrderController --resource
php artisan make:controller Admin/UserController --resource
php artisan make:controller Admin/MessageController --resource
```

*Tugas Controllers Admin:*
- `CategoryController`: Add/Update/Delete Kategori Buku.
- `BookController`: Add/Update/Delete Data Buku.
- `OrderController`: Melihat list pesanan dan mengupdate statusnya (pending -> completed).
- `UserController`: Menampilkan list semua user yang sudah terdaftar.
- `MessageController`: Menampilkan pesan "Contact to Admin".

### 2. User/Public Controllers (Frontend)
Controller ini bertugas menangani interaksi dari *User* (Pembeli) maupun pengguna biasa yang belum login (Guest):

```bash
php artisan make:controller AuthController
php artisan make:controller FrontController
php artisan make:controller CartController
php artisan make:controller CheckoutController
php artisan make:controller ContactController
```

*Tugas Controllers Frontend:*
- `AuthController`: Menangani logika tampilan & proses Login, Registrasi, serta Logout secara manual.
- `FrontController`: Menangani Halaman Home (katalog buku), detail buku, pencarian, dan halaman *About Us*.
- `CartController`: Menangani fitur "Add to Cart Buku".
- `CheckoutController`: Menangani proses "Payment at Delivery" (simpan order & kosongkan cart).
- `ContactController`: Menerima input form "Contact to Admin".

---

## 2. SETTING MIDDLEWARE (Penting di Laravel 11+)

Pastikan Middleware `AdminMiddleware` dan `UserMiddleware` yang sudah Anda buat, didaftarkan aliasisasinya (jika dibutuhkan) pada file `bootstrap/app.php` layaknya framework Laravel versi terbaru:

```php
// Di dalam bootstrap/app.php -> withMiddleware()
$middleware->alias([
    'admin' => \App\Http\Middleware\AdminMiddleware::class,
    'user' => \App\Http\Middleware\UserMiddleware::class,
]);
```

---

## 3. KERANGKA ROUTING (`routes/web.php`)

Gunakan kerangka routing ini di dalam file `routes/web.php` untuk memisahkan hak akses dari masing-masing aktor.

```php
<?php

use Illuminate\Support\Facades\Route;

// Import semua Controllers di sini
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\MessageController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES (Bisa Diakses Siapa Saja)
|--------------------------------------------------------------------------
*/
Route::get('/', [FrontController::class, 'index'])->name('home');
Route::get('/books', [FrontController::class, 'search'])->name('books.search');
Route::get('/about', [FrontController::class, 'about'])->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

/*
|--------------------------------------------------------------------------
| AUTH ROUTES (Autentikasi Manual / Tanpa Breeze)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');


/*
|--------------------------------------------------------------------------
| USER ROUTES (Harus Login & Role = User/Admin)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    // Cart Routes
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/{book}', [CartController::class, 'add'])->name('cart.add');
    Route::delete('/cart/{cartItem}', [CartController::class, 'destroy'])->name('cart.destroy');

    // Checkout / Payment at Delivery
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    
    // User Order History (Opsional)
    Route::get('/my-orders', [CheckoutController::class, 'history'])->name('user.orders');
});


/*
|--------------------------------------------------------------------------
| ADMIN ROUTES (Hanya Role = Admin)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Admin Dashboard (Opsional)
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // CRUD Resource
    Route::resource('categories', CategoryController::class);
    Route::resource('books', BookController::class);
    Route::resource('users', UserController::class)->only(['index', 'destroy']); // Hanya Lihat & Hapus
    Route::resource('messages', MessageController::class)->only(['index', 'show', 'destroy']);
    
    // Orders Management
    Route::resource('orders', OrderController::class)->only(['index', 'show', 'update']);
});

```

Selamat *ngoding*! Silakan jalankan pembuatan Controllernya dan mulai isi logika bisnis di dalamnya masing-masing.
