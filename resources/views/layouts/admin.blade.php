<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') — BookStore</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans">

<div class="flex min-h-screen">

    {{-- Sidebar --}}
    <aside class="w-64 bg-indigo-900 text-white flex flex-col fixed h-full">
        <div class="px-6 py-5 border-b border-indigo-700">
            <h1 class="text-xl font-bold">📚 BookStore</h1>
            <p class="text-xs text-indigo-300 mt-1">Admin Panel</p>
        </div>

        <nav class="flex-1 px-4 py-6 space-y-1">
            <a href="/admin/dashboard"
               class="flex items-center gap-3 px-4 py-2 rounded-lg text-sm hover:bg-indigo-700 transition
                      {{ request()->is('admin/dashboard') ? 'bg-indigo-700' : '' }}">
                🏠 Dashboard
            </a>
            <a href="/admin/categories"
               class="flex items-center gap-3 px-4 py-2 rounded-lg text-sm hover:bg-indigo-700 transition
                      {{ request()->is('admin/categories*') ? 'bg-indigo-700' : '' }}">
                🏷️ Kategori
            </a>
            <a href="/admin/books"
               class="flex items-center gap-3 px-4 py-2 rounded-lg text-sm hover:bg-indigo-700 transition
                      {{ request()->is('admin/books*') ? 'bg-indigo-700' : '' }}">
                📖 Buku
            </a>
            <a href="/admin/users"
               class="flex items-center gap-3 px-4 py-2 rounded-lg text-sm hover:bg-indigo-700 transition
                      {{ request()->is('admin/users*') ? 'bg-indigo-700' : '' }}">
                👥 Users
            </a>
            <a href="/admin/orders"
               class="flex items-center gap-3 px-4 py-2 rounded-lg text-sm hover:bg-indigo-700 transition
                      {{ request()->is('admin/orders*') ? 'bg-indigo-700' : '' }}">
                📦 Pesanan
            </a>
            <a href="/admin/messages"
               class="flex items-center gap-3 px-4 py-2 rounded-lg text-sm hover:bg-indigo-700 transition
                      {{ request()->is('admin/messages*') ? 'bg-indigo-700' : '' }}">
                💬 Pesan
            </a>
        </nav>

        {{-- Logout --}}
        <div class="px-4 py-4 border-t border-indigo-700">
            <p class="text-xs text-indigo-300 mb-2">{{ session('user')['name'] ?? 'Admin' }}</p>
            <form action="/logout" method="POST">
                @csrf
                <button type="submit"
                    class="w-full text-left text-sm text-red-300 hover:text-red-100 transition">
                    🚪 Logout
                </button>
            </form>
        </div>
    </aside>

    {{-- Main Content --}}
    <div class="ml-64 flex-1 p-8">

        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </div>
</div>

</body>
</html>