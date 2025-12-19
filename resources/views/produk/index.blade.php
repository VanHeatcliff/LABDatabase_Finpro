@extends('layouts.app')

@section('title', 'Katalog Produk')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <div class="flex flex-col md:flex-row justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Koleksi Terbaru</h1>
        
        <form action="{{ route('produk.index') }}" method="GET" class="mt-4 md:mt-0 flex">
            <input type="text" name="search" placeholder="Cari baju..." value="{{ request('search') }}"
                   class="border border-gray-300 rounded-l-md px-4 py-2 focus:ring-black focus:border-black">
            <button type="submit" class="bg-black text-white px-4 py-2 rounded-r-md hover:bg-gray-800">Cari</button>
        </form>
    </div>

    <div class="flex flex-col lg:flex-row gap-8">
        
        <aside class="w-full lg:w-1/4">
            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 sticky top-24">
                <h3 class="font-bold text-lg mb-4 border-b pb-2">Kategori</h3>
                <ul class="space-y-3">
                    <li>
                        <a href="{{ route('produk.index') }}" 
                           class="block {{ !request('kategori') ? 'font-bold text-black' : 'text-gray-600 hover:text-black' }}">
                            Semua Produk
                        </a>
                    </li>
                    @foreach($categories as $cat)
                        <li>
                            <a href="{{ route('produk.index', ['kategori' => $cat->ID_Kategori]) }}" 
                               class="block {{ request('kategori') == $cat->ID_Kategori ? 'font-bold text-black' : 'text-gray-600 hover:text-black' }}">
                                {{ $cat->Nama_Kategori }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </aside>

        <div class="w-full lg:w-3/4">
            @if($products->isEmpty())
                <div class="text-center py-20 bg-gray-50 rounded-lg">
                    <p class="text-gray-500 text-lg">Produk tidak ditemukan.</p>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($products as $produk)
                        <div class="group relative bg-white border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition-all duration-300">
                            <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden bg-gray-200 h-64">
                                <img src="{{ $produk->gambar_url ?? 'https://images.unsplash.com/photo-1523381210434-271e8be1f52b' }}" 
                                     alt="{{ $produk->Nama_Produk }}" 
                                     class="h-full w-full object-cover object-center group-hover:scale-105 transition-transform duration-300">
                                
                                <span class="absolute top-2 left-2 bg-black text-white text-xs px-2 py-1 rounded">
                                    {{ $produk->kategori->Nama_Kategori ?? 'Item' }}
                                </span>
                            </div>

                            <div class="p-4">
                                <h3 class="text-lg font-semibold text-gray-900 truncate">
                                    <a href="{{ route('produk.show', $produk->ID_Produk) }}">
                                        <span class="absolute inset-0"></span>
                                        {{ $produk->Nama_Produk }}
                                    </a>
                                </h3>
                                <div class="mt-2 flex items-center justify-between">
                                    <p class="text-lg font-bold text-gray-900">Rp {{ number_format($produk->Harga, 0, ',', '.') }}</p>
                                    <div class="bg-gray-100 p-2 rounded-full group-hover:bg-black group-hover:text-white transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="mt-8">
                    {{ $products->links() }} 
                </div>
            @endif
        </div>
    </div>
</div>
@endsection