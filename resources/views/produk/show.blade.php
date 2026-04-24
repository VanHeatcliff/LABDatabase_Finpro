@extends('layouts.app')

@section('title', $produk->Nama_Produk)

@section('content')
<div class="relative bg-gradient-to-br from-slate-50 via-white to-indigo-50/50 overflow-hidden">
    <!-- Decorative blobs -->
    <div class="absolute top-[-10%] left-[-5%] w-[40%] h-[40%] bg-indigo-200/40 blur-[120px] rounded-full pointer-events-none"></div>
    <div class="absolute bottom-[-10%] right-[-5%] w-[50%] h-[50%] bg-rose-200/30 blur-[120px] rounded-full pointer-events-none"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-16">
        
        <!-- Breadcrumb -->
        <nav class="flex mb-10 text-sm font-medium text-zinc-500" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="hover:text-zinc-900 transition-colors">Home</a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mx-1 text-zinc-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                        <a href="{{ route('produk.index') }}" class="ml-1 hover:text-zinc-900 transition-colors md:ml-2">Katalog</a>
                    </div>
                </li>
                @if($produk->kategori)
                <li>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mx-1 text-zinc-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                        <a href="{{ route('produk.index', ['kategori' => $produk->kategori->ID_Kategori]) }}" class="ml-1 hover:text-zinc-900 transition-colors md:ml-2">{{ $produk->kategori->Nama_Kategori }}</a>
                    </div>
                </li>
                @endif
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mx-1 text-zinc-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                        <span class="ml-1 text-zinc-900 font-semibold md:ml-2">{{ $produk->Nama_Produk }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="lg:grid lg:grid-cols-2 lg:gap-x-16 lg:items-start">
            
            <!-- Image Gallery/Main Image -->
            <div class="flex flex-col-reverse group">
                <div class="relative w-full aspect-[4/5] rounded-3xl overflow-hidden bg-zinc-100 shadow-2xl">
                    <img src="{{ $produk->gambar_url ?? 'https://images.unsplash.com/photo-1523381210434-271e8be1f52b' }}" 
                         alt="{{ $produk->Nama_Produk }}" 
                         class="w-full h-full object-center object-cover cursor-zoom-in transform transition-transform duration-1000 ease-out hover:scale-125">
                    
                    @if($produk->Stok <= 5 && $produk->Stok > 0)
                        <div class="absolute top-6 left-6">
                            <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold bg-white text-red-600 shadow-lg animate-pulse">
                                Segera Habis!
                            </span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Product Details -->
            <div class="mt-10 px-4 sm:px-0 sm:mt-16 lg:mt-0">
                <div class="mb-8 border-b border-zinc-200 pb-8">
                    @if($produk->kategori)
                        <span class="text-zinc-500 font-medium tracking-wider uppercase text-sm mb-2 block">{{ $produk->kategori->Nama_Kategori }}</span>
                    @endif
                    <h1 class="text-4xl sm:text-5xl font-extrabold tracking-tight text-zinc-900 mb-4">{{ $produk->Nama_Produk }}</h1>
                    <p class="text-4xl text-zinc-900 font-bold tracking-tight">Rp {{ number_format($produk->Harga, 0, ',', '.') }}</p>
                </div>

                <div class="mt-8">
                    <h3 class="sr-only">Status Stok</h3>
                    @if($produk->Stok > 5)
                        <div class="flex items-center text-emerald-600 font-medium">
                            <span class="w-3 h-3 rounded-full bg-emerald-500 mr-3"></span>
                            Tersedia ({{ $produk->Stok }} item)
                        </div>
                    @elseif($produk->Stok > 0)
                        <div class="flex items-center text-amber-600 font-medium">
                            <span class="w-3 h-3 rounded-full bg-amber-500 mr-3 animate-pulse"></span>
                            Sisa {{ $produk->Stok }} item lagi!
                        </div>
                    @else
                        <div class="flex items-center text-red-600 font-medium">
                            <span class="w-3 h-3 rounded-full bg-red-500 mr-3"></span>
                            Stok Habis
                        </div>
                    @endif
                </div>

                <div class="mt-8">
                    <h3 class="text-lg font-bold text-zinc-900 mb-4">Detail Produk</h3>
                    <div class="prose prose-zinc text-zinc-600 text-base leading-relaxed max-w-none">
                        <p>{{ $produk->Deskripsi ?? 'Pakaian eksklusif dengan material berkualitas premium. Didesain untuk memberikan kenyamanan maksimal dan penampilan yang selalu memukau di setiap kesempatan.' }}</p>
                    </div>
                </div>

                <form class="mt-10 pt-10 border-t border-zinc-200" action="{{ route('keranjang.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id_produk" value="{{ $produk->ID_Produk }}">

                    <div class="flex flex-col sm:flex-row gap-4 items-end">
                        <div class="w-full sm:w-32">
                            <label for="qty" class="block text-sm font-bold text-zinc-900 mb-2">Kuantitas</label>
                            <div class="relative">
                                <select id="qty" name="qty" class="appearance-none block w-full bg-zinc-50 border border-zinc-300 text-zinc-900 font-semibold py-4 px-5 rounded-xl focus:outline-none focus:ring-2 focus:ring-zinc-900 focus:border-transparent transition-all">
                                    @for($i = 1; $i <= min($produk->Stok, 10); $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-zinc-500">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </div>
                            </div>
                        </div>

                        <div class="w-full flex-1">
                            @if($produk->Stok > 0)
                                <button type="submit" class="w-full relative overflow-hidden bg-zinc-900 rounded-xl py-4 px-8 flex items-center justify-center text-lg font-bold text-white group hover:bg-zinc-800 transition-all shadow-xl shadow-zinc-900/20">
                                    <span class="absolute inset-0 w-full h-full bg-white/10 transform -translate-x-full group-hover:translate-x-full transition-transform duration-500 ease-out"></span>
                                    <span class="relative flex items-center gap-2">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                        Tambah ke Keranjang
                                    </span>
                                </button>
                            @else
                                <button type="button" disabled class="w-full bg-zinc-200 rounded-xl py-4 px-8 flex items-center justify-center text-lg font-bold text-zinc-500 cursor-not-allowed">
                                    Menunggu Restock
                                </button>
                            @endif
                        </div>
                    </div>
                </form>
                
                <!-- Trust Features -->
                <div class="mt-12 grid grid-cols-1 sm:grid-cols-2 gap-6 bg-zinc-50 rounded-2xl p-6 border border-zinc-100">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 bg-white p-2 rounded-lg shadow-sm border border-zinc-100">
                            <svg class="h-6 w-6 text-zinc-900" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-sm font-bold text-zinc-900">Garansi Kualitas</h4>
                            <p class="mt-1 text-xs text-zinc-500">Pengembalian gratis 30 hari.</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="flex-shrink-0 bg-white p-2 rounded-lg shadow-sm border border-zinc-100">
                            <svg class="h-6 w-6 text-zinc-900" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-sm font-bold text-zinc-900">Pengiriman Cepat</h4>
                            <p class="mt-1 text-xs text-zinc-500">Proses kirim dalam 24 jam.</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection