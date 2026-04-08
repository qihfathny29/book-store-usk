<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'BookStore')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-black text-gray-200 font-sans">

    {{-- Navbar --}}
    @if(!request()->is('login') && !request()->is('register'))
    <nav class="bg-black border-b border-red-900 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">
            {{-- Logo --}}
            <a href="/" class="text-2xl font-bold text-red-600">📚 BookStore</a>

            {{-- Menu --}}
            <div class="hidden md:flex items-center gap-6 text-sm font-medium text-gray-300">
                <a href="/" class="hover:text-red-500 transition">Home</a>
                <a href="/books" class="hover:text-red-500 transition">Buku</a>
                <a href="/about" class="hover:text-red-500 transition">About</a>
                <a href="/contact" class="hover:text-red-500 transition">Contact</a>
            </div>

            {{-- Auth & Cart --}}
            <div class="flex items-center gap-3">
                @if(session('user'))
                    {{-- Cart Icon --}}
                    <a href="/cart" class="relative text-gray-300 hover:text-red-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-10H5.4M7 13L5.4 5M7 13l-1.5 6h11"/>
                        </svg>
                    </a>

                    {{-- User Dropdown --}}
                    <div class="relative group">
                        <button class="flex items-center gap-1 text-sm font-medium text-gray-300 hover:text-red-500">
                            {{ session('user')['name'] }}
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div class="absolute right-0 mt-2 w-40 bg-zinc-900 rounded-lg shadow-lg border border-red-900
                                    opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all">
                            <a href="/orders" class="block px-4 py-2 text-sm text-gray-300 hover:bg-zinc-800">Pesanan Saya</a>
                            <form action="/logout" method="POST">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-2 text-sm text-red-500 hover:bg-zinc-800">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="/login"
                       class="text-sm font-medium text-gray-300 hover:text-white">Login</a>
                    <a href="/register"
                       class="text-sm font-medium bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition">
                        Register
                    </a>
                @endif
            </div>
        </div>
    </nav>
    @endif

    {{-- Flash Messages --}}
    <div class="fixed bottom-6 right-6 z-50 flex flex-col gap-3">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg shadow-lg">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg shadow-lg">
                {{ session('error') }}
            </div>
        @endif
    </div>

    {{-- Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    @if(!request()->is('login') && !request()->is('register'))
    <footer class="bg-black border-t border-red-900 text-gray-400 mt-16">
        <div class="max-w-7xl mx-auto px-4 py-10 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <h3 class="text-white text-lg font-bold mb-2">📚 BookStore</h3>
                <p class="text-sm">Toko buku online terpercaya dengan koleksi lengkap.</p>
            </div>
            <div>
                <h3 class="text-white font-semibold mb-2">Navigasi</h3>
                <ul class="text-sm space-y-1">
                    <li><a href="/" class="hover:text-red-500">Home</a></li>
                    <li><a href="/books" class="hover:text-red-500">Buku</a></li>
                    <li><a href="/about" class="hover:text-red-500">About Us</a></li>
                    <li><a href="/contact" class="hover:text-red-500">Contact</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-white font-semibold mb-2">Kontak</h3>
                <p class="text-sm">📧 bookstore@email.com</p>
                <p class="text-sm">📱 +62 812-3456-7890</p>
            </div>
        </div>
        <div class="text-center text-sm py-4 border-t border-red-900/50">
            © {{ date('Y') }} BookStore. All rights reserved.
        </div>
    </footer>
    @endif

</body>
</html>
