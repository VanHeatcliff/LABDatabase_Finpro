@extends('layouts.app')

@section('title', $produk->Nama_Produk)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    
    <nav class="text-sm text-gray-500 mb-6">
        <ol class="list-none p-0 inline-flex">
            <li class="flex items-center">
                <a href="{{ route('home') }}" class="hover:text-black">Home</a>
                <svg class="fill-current w-3 h-3 mx-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/></svg>
            </li>
            <li class="flex items-center">
                <a href="{{ route('produk.index') }}" class="hover:text-black">Katalog</a>
                <svg class="fill-current w-3 h-3 mx-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/></svg>
            </li>
            <li>
                <span class="text-black font-semibold">{{ $produk->Nama_Produk }}</span>
            </li>
        </ol>
    </nav>

    <div class="lg:grid lg:grid-cols-2 lg:gap-x-12 lg:items-start">
        
        <div class="flex flex-col-reverse">
            <div class="w-full aspect-w-1 aspect-h-1 bg-gray-200 rounded-lg overflow-hidden shadow-sm">
                <img src="{{ $produk->gambar_url ?? 'https://images.unsplash.com/photo-1523381210434-271e8be1f52b' }}" 
                     alt="{{ $produk->Nama_Produk }}" 
                     class="w-full h-full object-center object-cover hover:scale-105 transition-transform duration-500">
            </div>
        </div>

        <div class="mt-10 px-4 sm:px-0 sm:mt-16 lg:mt-0">
            <h1 class="text-3xl font-extrabold tracking-tight text-gray-900">{{ $produk->Nama_Produk }}</h1>
            
            <div class="mt-3">
                <h2 class="sr-only">Informasi Produk</h2>
                <p class="text-3xl text-gray-900 font-bold">Rp {{ number_format($produk->Harga, 0, ',', '.') }}</p>
            </div>

            <div class="mt-4">
                @if($produk->Stok > 5)
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        Stok Tersedia ({{ $produk->Stok }})
                    </span>
                @elseif($produk->Stok > 0)
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                        Stok Menipis! Sisa {{ $produk->Stok }}
                    </span>
                @else
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                        Habis
                    </span>
                @endif
            </div>

            <div class="mt-6">
                <h3 class="sr-only">Deskripsi</h3>
                <div class="text-base text-gray-700 space-y-6">
                    <p>{{ $produk->Deskripsi ?? 'Bahan berkualitas tinggi yang nyaman dipakai sehari-hari. Desain modern yang cocok untuk berbagai aktivitas.' }}</p>
                </div>
            </div>

            <form class="mt-8" action="{{ route('keranjang.add') }}" method="POST">
                @csrf
                <input type="hidden" name="id_produk" value="{{ $produk->ID_Produk }}">

                <div class="flex items-end gap-4">
                    <div class="w-1/4">
                        <label for="qty" class="block text-sm font-medium text-gray-700">Jumlah</label>
                        <select id="qty" name="qty" class="mt-1 block w-full pl-3 pr-10 py-3 text-base border-gray-300 focus:outline-none focus:ring-black focus:border-black sm:text-sm rounded-md">
                            @for($i = 1; $i <= min($produk->Stok, 10); $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>

                    <div class="flex-1">
                        @if($produk->Stok > 0)
                            <button type="submit" class="w-full bg-black border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-white hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-black transition">
                                Tambah ke Keranjang
                            </button>
                        @else
                            <button type="button" disabled class="w-full bg-gray-300 border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-white cursor-not-allowed">
                                Stok Habis
                            </button>
                        @endif
                    </div>
                </div>
            </form>
            
            <div class="mt-8 border-t border-gray-200 pt-8">
                <div class="flex items-center text-sm text-gray-500">
                    <svg class="flex-shrink-0 h-6 w-6 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Garansi Pengembalian 30 Hari
                </div>
                <div class="flex items-center text-sm text-gray-500 mt-2">
                    <svg class="flex-shrink-0 h-6 w-6 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                    Pengiriman Cepat (1-3 Hari)
                </div>
            </div>

        </div>
    </div>
</div>
@endsection