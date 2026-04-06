@extends('layouts.app')
@section('title', 'About Us — BookStore')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-16">

    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-800 mb-4">Tentang Kami</h1>
        <p class="text-gray-500 text-lg">Kenali lebih dekat BookStore dan misi kami</p>
    </div>

    <div class="grid md:grid-cols-2 gap-10 items-center mb-16">
        <img src="https://images.unsplash.com/photo-1507842217343-583bb7270b66?w=600"
             alt="About" class="rounded-2xl shadow-lg w-full object-cover h-72">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Siapa Kami?</h2>
            <p class="text-gray-600 leading-relaxed mb-4">
                BookStore adalah toko buku online yang didirikan dengan semangat menyebarkan
                ilmu pengetahuan dan budaya membaca di seluruh Indonesia.
            </p>
            <p class="text-gray-600 leading-relaxed">
                Kami menyediakan ribuan judul buku dari berbagai kategori dengan harga terjangkau
                dan sistem pembayaran yang mudah — bayar saat buku tiba di tanganmu!
            </p>
        </div>
    </div>

    {{-- Values --}}
    <div class="grid md:grid-cols-3 gap-6 mb-16">
        <div class="bg-indigo-50 rounded-xl p-6 text-center">
            <div class="text-4xl mb-3">📖</div>
            <h3 class="font-bold text-gray-800 mb-2">Koleksi Lengkap</h3>
            <p class="text-sm text-gray-600">Ribuan judul buku dari berbagai genre dan kategori</p>
        </div>
        <div class="bg-purple-50 rounded-xl p-6 text-center">
            <div class="text-4xl mb-3">🚚</div>
            <h3 class="font-bold text-gray-800 mb-2">COD Tersedia</h3>
            <p class="text-sm text-gray-600">Bayar saat buku tiba, aman dan terpercaya</p>
        </div>
        <div class="bg-pink-50 rounded-xl p-6 text-center">
            <div class="text-4xl mb-3">💬</div>
            <h3 class="font-bold text-gray-800 mb-2">Support 24/7</h3>
            <p class="text-sm text-gray-600">Tim kami siap membantu kapan saja kamu butuhkan</p>
        </div>
    </div>

</div>
@endsection