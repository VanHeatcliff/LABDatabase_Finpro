@extends('layouts.app')

@section('content')

<div class="relative bg-white overflow-hidden mb-16 rounded-3xl">
    <div class="pt-16 pb-80 sm:pt-24 sm:pb-40 lg:pt-40 lg:pb-48">
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 sm:static">
            <div class="sm:max-w-lg">
                <h1 class="text-4xl font font-extrabold tracking-tight text-gray-900 sm:text-6xl">
                    Gaya Musim Ini Akhirnya Tiba
                </h1>
                <p class="mt-4 text-xl text-gray-500">
                    Temukan koleksi pakaian terbaru dengan bahan berkualitas tinggi. Tampil percaya diri dengan desain eksklusif kami.
                </p>
                <div class="mt-10">
                    <a href="{{ route('produk.index') }}" class="inline-block text-center bg-black border border-transparent rounded-md py-3 px-8 font-medium text-white hover:bg-gray-800">
                        Belanja Sekarang
                    </a>
                </div>
            </div>
            
            <div class="hidden lg:block absolute top-0 right-0 transform translate-x-1/2 -translate-y-1/2 lg:translate-x-8 lg:translate-y-1/4">
                <div class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-2">
                    <div class="space-y-4">
                        <img src="https://i.pinimg.com/474x/61/fe/bb/61febb04c2f883d6b53eb7a9074ff911.jpg" class="rounded-2xl shadow-xl w-44 h-64 object-cover">
                        <img src="https://images.pexels.com/photos/18368140/pexels-photo-18368140.jpeg" class="rounded-2xl shadow-xl w-44 h-64 object-cover">
                    </div>
                    <div class="space-y-4 pt-12">
                        <img src="https://wimg.mk.co.kr/news/cms/202502/28/news-p.v1.20250228.e815bfda4cd5472da70464d10b15c1a9_P1.jpg" class="rounded-2xl shadow-xl w-44 h-64 object-cover">
                        <img src="https://images.pexels.com/photos/29096397/pexels-photo-29096397.jpeg" class="rounded-2xl shadow-xl w-44 h-64 object-cover">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-16">
    <h2 class="text-2xl font-bold tracking-tight text-gray-900 mb-6">Belanja Berdasarkan Kategori</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="relative rounded-lg overflow-hidden group cursor-pointer h-64">
            <img src="https://images.unsplash.com/photo-1617137968427-85924c800a22?auto=format&fit=crop&q=80&w=600" class="w-full h-full object-cover transition transform group-hover:scale-110 duration-500">
            <div class="absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center">
                <h3 class="text-white text-2xl font-bold">Pria</h3>
            </div>
        </div>
        <div class="relative rounded-lg overflow-hidden group cursor-pointer h-64">
            <img src="https://images.unsplash.com/photo-1525507119028-ed4c629a60a3?auto=format&fit=crop&q=80&w=600" class="w-full h-full object-cover transition transform group-hover:scale-110 duration-500">
            <div class="absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center">
                <h3 class="text-white text-2xl font-bold">Wanita</h3>
            </div>
        </div>
        <div class="relative rounded-lg overflow-hidden group cursor-pointer h-64">
            <img src="https://images.unsplash.com/photo-1596870230751-ebdfce98ec42?auto=format&fit=crop&q=80&w=600" class="w-full h-full object-cover transition transform group-hover:scale-110 duration-500">
            <div class="absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center">
                <h3 class="text-white text-2xl font-bold">Aksesoris</h3>
            </div>
        </div>
    </div>
</div>

@endsection