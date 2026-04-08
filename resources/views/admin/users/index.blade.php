@extends('layouts.admin')
@section('title', 'Data User')

@section('content')
<div class="flex items-center gap-3 mb-8 border-b-2 border-red-600 pb-4 inline-flex">
    <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
    <h1 class="text-3xl font-extrabold text-white">Data User</h1>
</div>

<div class="bg-zinc-900 border border-red-900/50 rounded-xl shadow-[0_0_15px_rgba(220,38,38,0.1)] overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="bg-black text-red-500 uppercase text-xs font-bold border-b border-red-900/50">
                <tr>
                    <th class="px-6 py-4">#</th>
                    <th class="px-6 py-4">Nama</th>
                    <th class="px-6 py-4">Email</th>
                    <th class="px-6 py-4">No. Telepon</th>
                    <th class="px-6 py-4">Alamat</th>
                    <th class="px-6 py-4">Bergabung</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-red-900/30">
                @forelse($users as $user)
                <tr class="hover:bg-zinc-800 transition-colors">
                    <td class="px-6 py-4 text-gray-500">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4 font-bold text-white">{{ $user->name }}</td>
                    <td class="px-6 py-4 text-gray-400">{{ $user->email }}</td>
                    <td class="px-6 py-4 text-gray-400">{{ $user->phone ?? '-' }}</td>
                    <td class="px-6 py-4 text-gray-400">
                        <span class="line-clamp-1">{{ $user->address ?? '-' }}</span>
                    </td>
                    <td class="px-6 py-4 text-gray-500">{{ $user->created_at->format('d M Y') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-10 text-center text-gray-500 bg-black">Belum ada user</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-6 py-4 bg-black border-t border-red-900/50">{{ $users->links() }}</div>
</div>
@endsection
