@extends('layouts.user')
@section('title', 'Profil Saya — BookStore')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-10">

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-white mb-2">👤 Profil Saya</h1>
        <p class="text-gray-400">Atur dan lengkapi data diri Anda di sini.</p>
    </div>

    <div class="bg-black border border-red-900/50 rounded-2xl shadow-xl p-6 md:p-8">
        <form action="/profile" method="POST">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                {{-- Nama --}}
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                           class="w-full bg-zinc-900 border border-zinc-800 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 transition-colors">
                    @error('name') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
                </div>

                {{-- Email (Readonly) --}}
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">Email</label>
                    <input type="email" value="{{ $user->email }}" disabled
                           class="w-full bg-zinc-900/50 border border-zinc-800/50 rounded-xl px-4 py-3 text-gray-500 cursor-not-allowed">
                    <p class="text-xs text-gray-600 mt-1">Email tidak dapat diubah karena merupakan identitas login.</p>
                </div>

                {{-- Telepon --}}
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">Nomor Telepon</label>
                    <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                           class="w-full bg-zinc-900 border border-zinc-800 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 transition-colors" placeholder="Contoh: 081234567890">
                    @error('phone') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
                </div>

                {{-- Alamat --}}
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">Alamat Lengkap</label>
                    <textarea name="address" rows="3"
                              class="w-full bg-zinc-900 border border-zinc-800 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 transition-colors resize-none" placeholder="Masukkan alamat lengkap pengiriman">{{ old('address', $user->address) }}</textarea>
                    @error('address') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
                </div>

                <hr class="border-red-900/30 my-6">

                {{-- Password Baru --}}
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">Password Baru (Opsional)</label>
                    <input type="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah password"
                           class="w-full bg-zinc-900 border border-zinc-800 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 transition-colors">
                    @error('password') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
                </div>

                {{-- Konfirmasi Password --}}
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" placeholder="Ketik ulang password baru Anda"
                           class="w-full bg-zinc-900 border border-zinc-800 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 transition-colors">
                </div>

            </div>

            <div class="mt-8 pt-6 border-t border-red-900/30 flex justify-end">
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-8 py-3 rounded-xl font-bold transition-all shadow-lg shadow-red-600/20 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection