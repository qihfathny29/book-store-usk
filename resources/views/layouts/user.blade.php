<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'BookStore')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-zinc-950 font-sans text-gray-200">

    {{-- Sidebar & Content Layout --}}
    <div class="flex min-h-screen">
        {{-- Sidebar --}}
        <aside class="w-64 bg-black border-r border-red-900 shadow-lg fixed h-full z-40 flex flex-col hidden md:flex">
            <div class="px-6 py-6 border-b border-red-900/50 flex-shrink-0">
                <a href="/" class="text-2xl font-bold text-red-600 flex items-center gap-2">
                    📚 <span class="tracking-tight text-white">BookStore</span>
                </a>
            </div>

            <div class="px-4 py-6 flex-1 overflow-y-auto">
                <div class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-4">Menu Utama</div>
                <nav class="space-y-2">
                    <a href="/home" class="{{ request()->is('home*') ? 'bg-red-900/30 text-white border border-red-800' : 'text-gray-400 hover:text-white hover:bg-zinc-900' }} flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl transition-all">
                        <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        Dashboard
                    </a>
                    <a href="/user/books" class="{{ request()->is('user/books*') ? 'bg-red-900/30 text-white border border-red-800' : 'text-gray-400 hover:text-white hover:bg-zinc-900' }} flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl transition-all">
                        <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        Katalog Buku
                    </a>
                    <a href="/cart" class="{{ request()->is('cart*') ? 'bg-red-900/30 text-white border border-red-800' : 'text-gray-400 hover:text-white hover:bg-zinc-900' }} flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl transition-all">
                        <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-10H5.4M7 13L5.4 5M7 13l-1.5 6h11"></path></svg>
                        Keranjang
                    </a>
                    <a href="/checkout" class="{{ request()->is('checkout*') ? 'bg-red-900/30 text-white border border-red-800' : 'text-gray-400 hover:text-white hover:bg-zinc-900' }} flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl transition-all">
                        <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Checkout
                    </a>
                    <a href="/orders" class="{{ request()->is('orders*') ? 'bg-red-900/30 text-white border border-red-800' : 'text-gray-400 hover:text-white hover:bg-zinc-900' }} flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl transition-all">
                        <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                        Pesanan Saya
                    </a>
                </nav>

                <div class="text-xs font-semibold text-gray-500 uppercase tracking-wider mt-8 mb-4">Pengaturan</div>
                <nav class="space-y-1">
                    <a href="/profile" class="{{ request()->is('profile*') ? 'bg-red-900/30 text-white border border-red-800' : 'text-gray-400 hover:text-white hover:bg-zinc-900' }} flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl transition-all">
                        <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        Profil Saya
                    </a>
                    <form action="/logout" method="POST" class="mt-2">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-sm font-medium text-red-500 hover:text-white hover:bg-red-900/50 rounded-xl transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            Logout
                        </button>
                    </form>
                </nav>
            </div>

            <div class="px-6 py-4 border-t border-red-900/50 bg-black flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-red-900/50 border border-red-600 flex items-center justify-center text-white font-bold">
                    {{ substr(session('user')['name'] ?? 'U', 0, 1) }}
                </div>
                <div class="flex-1 min-w-0">
                    <h4 class="text-sm font-bold text-white truncate">{{ session('user')['name'] ?? 'User' }}</h4>
                    <p class="text-xs text-red-500">Member</p>
                </div>
            </div>
        </aside>

        {{-- Main Content Area --}}
        <div class="flex-1 md:ml-64 flex flex-col min-h-screen">
            {{-- Mobile Header --}}
            <header class="bg-black border-b border-red-900 px-6 py-4 flex md:hidden items-center justify-between sticky top-0 z-30">
                <a href="/" class="text-xl font-bold text-red-600">📚 <span class="text-white">BookStore</span></a>
                <button class="text-gray-400 hover:text-red-500 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                </button>
            </header>

            {{-- Flash Messages --}}
            <div class="fixed bottom-6 right-6 z-50 flex flex-col gap-3">
                @if(session('success'))
                    <div class="bg-zinc-900 border border-green-500 text-green-400 px-4 py-3 rounded-lg shadow-[0_0_10px_rgba(34,197,94,0.2)]">
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="bg-zinc-900 border border-red-500 text-red-500 px-4 py-3 rounded-lg shadow-[0_0_10px_rgba(239,68,68,0.2)]">
                        {{ session('error') }}
                    </div>
                @endif
            </div>

            {{-- Content --}}
            <main class="p-6 md:p-8 flex-1">
                @yield('content')
            </main>
        </div>
    </div>

</body>
</html>
