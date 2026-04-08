<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') — BookStore</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-zinc-950 font-sans text-gray-200">

<div class="flex min-h-screen">

    {{-- Sidebar --}}
    <aside class="w-64 bg-black border-r border-red-900 text-gray-200 flex flex-col fixed h-full z-40 shadow-lg">
        <div class="px-6 py-5 border-b border-red-900/50">
            <h1 class="text-xl font-bold text-red-600 flex items-center gap-2">
                <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                <span class="tracking-tight text-white">BookStore</span>
            </h1>
            <p class="text-xs text-red-500 mt-1 font-semibold uppercase tracking-wider">Admin Panel</p>
        </div>

        <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
            <a href="/admin/dashboard"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all
                      {{ request()->is('admin/dashboard') ? 'bg-red-900/30 text-white border border-red-800' : 'text-gray-400 hover:text-white hover:bg-zinc-900' }}">
                <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                Dashboard
            </a>
            <a href="/admin/categories"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all
                      {{ request()->is('admin/categories*') ? 'bg-red-900/30 text-white border border-red-800' : 'text-gray-400 hover:text-white hover:bg-zinc-900' }}">
                <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                Kategori
            </a>
            <a href="/admin/books"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all
                      {{ request()->is('admin/books*') ? 'bg-red-900/30 text-white border border-red-800' : 'text-gray-400 hover:text-white hover:bg-zinc-900' }}">
                <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                Buku
            </a>
            <a href="/admin/users"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all
                      {{ request()->is('admin/users*') ? 'bg-red-900/30 text-white border border-red-800' : 'text-gray-400 hover:text-white hover:bg-zinc-900' }}">
                <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                Users
            </a>
            <a href="/admin/orders"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all
                      {{ request()->is('admin/orders*') ? 'bg-red-900/30 text-white border border-red-800' : 'text-gray-400 hover:text-white hover:bg-zinc-900' }}">
                <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                Pesanan
            </a>
            <a href="/admin/messages"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all
                      {{ request()->is('admin/messages*') ? 'bg-red-900/30 text-white border border-red-800' : 'text-gray-400 hover:text-white hover:bg-zinc-900' }}">
                <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                Pesan
            </a>
        </nav>

        {{-- Logout --}}
        <div class="px-4 py-6 border-t border-red-900/50 bg-black">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-8 h-8 rounded-full bg-red-900/50 border border-red-600 flex items-center justify-center text-white font-bold text-sm">
                    {{ substr(session('user')['name'] ?? 'A', 0, 1) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-bold text-white truncate">{{ session('user')['name'] ?? 'Admin' }}</p>
                </div>
            </div>
            
            <form action="/logout" method="POST">
                @csrf
                <button type="submit"
                    class="w-full flex items-center gap-3 px-4 py-2 text-sm font-medium text-red-500 hover:text-white hover:bg-red-900/50 rounded-xl transition-all border border-transparent hover:border-red-800">
                    <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    {{-- Main Content --}}
    <div class="ml-64 flex-1 p-8">

        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="bg-zinc-900 border border-green-500 text-green-400 px-4 py-3 rounded-lg shadow-[0_0_10px_rgba(34,197,94,0.2)] mb-6">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-zinc-900 border border-red-500 text-red-500 px-4 py-3 rounded-lg shadow-[0_0_10px_rgba(239,68,68,0.2)] mb-6">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </div>
</div>

</body>
</html>
