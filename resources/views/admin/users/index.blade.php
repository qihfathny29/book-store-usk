@extends('layouts.admin')
@section('title', 'Data User')

@section('content')
<h1 class="text-2xl font-bold text-gray-800 mb-6">👥 Data User</h1>

<div class="bg-white rounded-xl shadow overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
            <tr>
                <th class="px-6 py-3 text-left">#</th>
                <th class="px-6 py-3 text-left">Nama</th>
                <th class="px-6 py-3 text-left">Email</th>
                <th class="px-6 py-3 text-left">No. Telepon</th>
                <th class="px-6 py-3 text-left">Alamat</th>
                <th class="px-6 py-3 text-left">Bergabung</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($users as $user)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 text-gray-500">{{ $loop->iteration }}</td>
                <td class="px-6 py-4 font-medium text-gray-800">{{ $user->name }}</td>
                <td class="px-6 py-4 text-gray-600">{{ $user->email }}</td>
                <td class="px-6 py-4 text-gray-600">{{ $user->phone ?? '-' }}</td>
                <td class="px-6 py-4 text-gray-600">
                    <span class="line-clamp-1">{{ $user->address ?? '-' }}</span>
                </td>
                <td class="px-6 py-4 text-gray-500">{{ $user->created_at->format('d M Y') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-10 text-center text-gray-400">Belum ada user</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="px-6 py-4">{{ $users->links() }}</div>
</div>
@endsection