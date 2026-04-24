@extends('layouts.app')

@section('title', 'Katalog Produk')

@section('content')
<div class="relative bg-zinc-50 py-12 border-b border-zinc-200 overflow-hidden">
    <!-- Decorative Gradients -->
    <div class="absolute top-0 left-1/4 w-[40%] h-[200%] bg-gradient-to-br from-indigo-200/40 via-purple-100/20 to-transparent rounded-full blur-[100px] transform -rotate-12 pointer-events-none"></div>
    <div class="absolute bottom-0 right-0 w-[50%] h-[150%] bg-gradient-to-tl from-rose-200/30 via-orange-100/20 to-transparent rounded-full blur-[100px] pointer-events-none"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-extrabold text-zinc-900 tracking-tight mb-4">Koleksi Eksklusif</h1>
        <p class="text-lg text-zinc-500 max-w-2xl mx-auto">Eksplorasi gaya tanpa batas dengan pilihan produk terbaik kami yang dirancang untuk menyempurnakan penampilan Anda.</p>
    </div>
</div>

<div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Subtle background tint for the whole section -->
    <div class="absolute inset-0 bg-gradient-to-b from-indigo-50/30 via-transparent to-rose-50/30 z-0 pointer-events-none rounded-[3rem]"></div>
    
    <div class="relative z-10 flex flex-col lg:flex-row gap-12">
        
        <!-- Sidebar Kategori -->
        <aside class="w-full lg:w-1/4">
            <div class="sticky top-24">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="font-bold text-xl text-zinc-900 tracking-wide uppercase">Kategori</h3>
                    <span class="w-10 h-px bg-zinc-300"></span>
                </div>
                
                <form action="{{ route('produk.index') }}" method="GET" class="mb-8">
                    <div class="relative">
                        <input type="text" name="search" placeholder="Cari gaya Anda..." value="{{ request('search') }}"
                               class="w-full bg-zinc-100 border-transparent rounded-full pl-5 pr-12 py-3 text-sm focus:border-zinc-300 focus:bg-white focus:ring-0 transition-colors">
                        <button type="submit" class="absolute right-2 top-1/2 transform -translate-y-1/2 p-2 text-zinc-400 hover:text-zinc-900 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </button>
                    </div>
                </form>

                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('produk.index') }}" 
                           class="flex items-center justify-between py-2 px-4 rounded-xl transition-all {{ !request('kategori') ? 'bg-zinc-900 text-white font-medium shadow-md' : 'text-zinc-500 hover:bg-zinc-100 hover:text-zinc-900' }}">
                            <span>Semua Produk</span>
                            @if(!request('kategori'))
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            @endif
                        </a>
                    </li>
                    @foreach($categories as $cat)
                        <li>
                            <a href="{{ route('produk.index', ['kategori' => $cat->ID_Kategori]) }}" 
                               class="flex items-center justify-between py-2 px-4 rounded-xl transition-all {{ request('kategori') == $cat->ID_Kategori ? 'bg-zinc-900 text-white font-medium shadow-md' : 'text-zinc-500 hover:bg-zinc-100 hover:text-zinc-900' }}">
                                <span>{{ $cat->Nama_Kategori }}</span>
                                @if(request('kategori') == $cat->ID_Kategori)
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                @endif
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </aside>

        <!-- Product Grid -->
        <div class="w-full lg:w-3/4">
            @if($products->isEmpty())
                <div class="flex flex-col items-center justify-center py-32 text-center bg-zinc-50 rounded-3xl border border-dashed border-zinc-200">
                    <svg class="w-16 h-16 text-zinc-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                    <h3 class="text-xl font-bold text-zinc-900 mb-2">Produk Tidak Ditemukan</h3>
                    <p class="text-zinc-500 max-w-md">Maaf, kami tidak dapat menemukan produk yang sesuai dengan pencarian atau filter Anda. Coba kata kunci lain.</p>
                    <a href="{{ route('produk.index') }}" class="mt-6 inline-flex items-center justify-center px-6 py-2 border border-zinc-300 rounded-full text-sm font-medium text-zinc-700 bg-white hover:bg-zinc-50 transition">
                        Reset Filter
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-12">
                    @foreach($products as $produk)
                        <div class="group relative flex flex-col">
                            <!-- Image Container -->
                            <div class="relative w-full aspect-[3/4] rounded-2xl overflow-hidden bg-zinc-100 mb-4 cursor-pointer">
                                <img src="{{ $produk->gambar_url ?? 'https://images.unsplash.com/photo-1523381210434-271e8be1f52b' }}" 
                                     alt="{{ $produk->Nama_Produk }}" 
                                     class="w-full h-full object-cover object-center transform transition-transform duration-700 ease-out group-hover:scale-110">
                                
                                <!-- Overlay and Quick Actions -->
                                <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                
                                <!-- Category Badge -->
                                <div class="absolute top-4 left-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold tracking-wider uppercase bg-white/90 backdrop-blur-sm text-zinc-900 shadow-sm">
                                        {{ $produk->kategori->Nama_Kategori ?? 'Item' }}
                                    </span>
                                </div>
                                
                                <!-- Quick View Button -->
                                <div class="absolute bottom-4 left-4 right-4 translate-y-8 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300">
                                    <a href="{{ route('produk.show', $produk->ID_Produk) }}" class="w-full block text-center bg-white/95 backdrop-blur-md text-zinc-900 font-bold py-3 rounded-xl shadow-lg hover:bg-zinc-900 hover:text-white transition-colors">
                                        Lihat Detail
                                    </a>
                                </div>
                            </div>

                            <!-- Product Info -->
                            <div class="flex flex-col flex-1">
                                <h3 class="text-lg font-bold text-zinc-900 line-clamp-1 group-hover:text-zinc-600 transition-colors">
                                    <a href="{{ route('produk.show', $produk->ID_Produk) }}">
                                        {{ $produk->Nama_Produk }}
                                    </a>
                                </h3>
                                <div class="mt-2 flex items-center justify-between">
                                    <p class="text-lg font-extrabold text-zinc-900 tracking-tight">Rp {{ number_format($produk->Harga, 0, ',', '.') }}</p>
                                    @if($produk->Stok <= 5 && $produk->Stok > 0)
                                        <span class="text-xs font-medium text-red-500 bg-red-50 px-2 py-1 rounded-md">Sisa {{ $produk->Stok }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <!-- Pagination -->
                <div class="mt-16 flex justify-center">
                    {{ $products->links() }} 
                </div>
            @endif
        </div>
    </div>
</div>
@endsection