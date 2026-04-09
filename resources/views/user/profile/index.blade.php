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

    {{-- Kotak Masuk / Tiket Bantuan --}}
    <div class="mt-12 bg-black border border-zinc-800 rounded-2xl shadow-xl p-6 md:p-8">
        <h2 class="text-2xl font-bold text-white mb-6">&#128233; Kotak Masuk Pesan</h2>
        
        @if($messages->isEmpty())
            <div class="text-center py-8">
                <p class="text-gray-500">Anda belum pernah mengirim pesan bantuan.</p>
                <a href="/contact" class="text-red-500 hover:underline text-sm mt-3 inline-block">Kirim Pesan Sekarang</a>
            </div>
        @else
            <div class="space-y-6">
                @foreach($messages as $msg)
                <div class="bg-zinc-900/50 border border-zinc-800 rounded-xl p-5 relative overflow-hidden">
                    {{-- Indikator Status --}}
                    <div class="absolute top-0 left-0 w-1 h-full {{ $msg->admin_reply ? 'bg-green-500' : 'bg-yellow-500' }}"></div>
                    
                    <div class="flex justify-between items-start mb-3 pl-2">
                        <div>
                            <span class="text-xs font-bold px-2 py-1 rounded {{ $msg->admin_reply ? 'bg-green-500/20 text-green-400' : 'bg-yellow-500/20 text-yellow-400' }}">
                                {{ $msg->admin_reply ? 'Dibalas' : 'Menunggu Balasan' }}
                            </span>
                            <span class="text-xs text-gray-500 ml-3">{{ $msg->created_at->format('d M Y, H:i') }}</span>
                        </div>
                    </div>

                    {{-- Pesan User --}}
                    <div class="pl-2 mb-4">
                        <p class="text-sm text-gray-400 font-bold mb-1">Pesan Anda:</p>
                        <p class="text-gray-300 leading-relaxed">{{ $msg->message }}</p>
                    </div>

                    {{-- Balasan Admin --}}
                    @if($msg->admin_reply)
                    <div class="pl-2 pt-4 border-t border-zinc-800">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="w-6 h-6 rounded-full bg-red-600 flex items-center justify-center text-xs font-bold text-white">A</span>
                            <p class="text-sm font-bold text-white">Admin BookStore</p>
                        </div>
                        <p class="text-gray-300 leading-relaxed pl-8">{{ $msg->admin_reply }}</p>
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
        @endif
    </div>

</div>
@endsection