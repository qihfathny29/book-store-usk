<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'BookStore')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-sans">

    {{-- Navbar --}}
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">
            {{-- Logo --}}
            <a href="/" class="text-2xl font-bold text-indigo-600">📚 BookStore</a>

            {{-- Menu --}}
            <div class="hidden md:flex items-center gap-6 text-sm font-medium text-gray-600">
                <a href="/" class="hover:text-indigo-600 transition">Home</a>
                <a href="/books" class="hover:text-indigo-600 transition">Buku</a>
                <a href="/about" class="hover:text-indigo-600 transition">About</a>
                <a href="/contact" class="hover:text-indigo-600 transition">Contact</a>
            </div>

            {{-- Auth & Cart --}}
            <div class="flex items-center gap-3">
                @if(session('user'))
                    {{-- Cart Icon --}}
                    <a href="/cart" class="relative text-gray-600 hover:text-indigo-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-10H5.4M7 13L5.4 5M7 13l-1.5 6h11"/>
                        </svg>
                    </a>

                    {{-- User Dropdown --}}
                    <div class="relative group">
                        <button class="flex items-center gap-1 text-sm font-medium text-gray-700 hover:text-indigo-600">
                            {{ session('user')['name'] }}
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div class="absolute right-0 mt-2 w-40 bg-white rounded-lg shadow-lg border
                                    opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all">
                            <a href="/orders" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50">Pesanan Saya</a>
                            <form action="/logout" method="POST">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="/login"
                       class="text-sm font-medium text-gray-600 hover:text-indigo-600">Login</a>
                    <a href="/register"
                       class="text-sm font-medium bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
                        Register
                    </a>
                @endif
            </div>
        </div>
    </nav>

    {{-- Flash Messages --}}
    <div class="max-w-7xl mx-auto px-4 mt-4">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4">
                {{ session('error') }}
            </div>
        @endif
    </div>

    {{-- Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-gray-800 text-gray-300 mt-16">
        <div class="max-w-7xl mx-auto px-4 py-10 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <h3 class="text-white text-lg font-bold mb-2">📚 BookStore</h3>
                <p class="text-sm">Toko buku online terpercaya dengan koleksi lengkap.</p>
            </div>
            <div>
                <h3 class="text-white font-semibold mb-2">Navigasi</h3>
                <ul class="text-sm space-y-1">
                    <li><a href="/" class="hover:text-white">Home</a></li>
                    <li><a href="/books" class="hover:text-white">Buku</a></li>
                    <li><a href="/about" class="hover:text-white">About Us</a></li>
                    <li><a href="/contact" class="hover:text-white">Contact</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-white font-semibold mb-2">Kontak</h3>
                <p class="text-sm">📧 bookstore@email.com</p>
                <p class="text-sm">📱 +62 812-3456-7890</p>
            </div>
        </div>
        <div class="text-center text-sm py-4 border-t border-gray-700">
            © {{ date('Y') }} BookStore. All rights reserved.
        </div>
    </footer>

</body>
</html>