@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <h1 class="text-3xl font-bold mb-8">Keranjang Belanja Kamu</h1>

    @if(!$keranjang || $keranjang->details->isEmpty())
        <div class="text-center py-16 bg-white rounded-lg border border-dashed border-gray-300">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">Keranjang kosong</h3>
            <p class="mt-1 text-sm text-gray-500">Kamu belum menambahkan produk apapun.</p>
            <div class="mt-6">
                <a href="{{ route('produk.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-black hover:bg-gray-800">
                    Mulai Belanja
                </a>
            </div>
        </div>
    @else
        <div class="flex flex-col lg:flex-row gap-8">
            
            <div class="w-full lg:w-2/3">
                <div class="bg-white shadow-sm border border-gray-200 rounded-lg overflow-hidden">
                    <ul class="divide-y divide-gray-200">
                        @php $totalBelanja = 0; @endphp
                        
                        @foreach($keranjang->details as $item)
                            @php 
                                // PERBAIKAN 1: Pakai 'jumlah' (huruf kecil)
                                $subtotal = $item->produk->Harga * $item->jumlah;
                                $totalBelanja += $subtotal;
                            @endphp

                            <li class="p-6 flex items-center">
                                <div class="h-24 w-24 flex-shrink-0 overflow-hidden rounded-md border border-gray-200">
                                    <img src="{{ $item->produk->gambar ?? 'https://via.placeholder.com/150' }}" 
                                         alt="{{ $item->produk->Nama_Produk }}" 
                                         class="h-full w-full object-cover object-center">
                                </div>

                                <div class="ml-4 flex-1 flex flex-col">
                                    <div>
                                        <div class="flex justify-between text-base font-medium text-gray-900">
                                            <h3>
                                                <a href="{{ route('produk.show', $item->produk->ID_Produk) }}">
                                                    {{ $item->produk->Nama_Produk }}
                                                </a>
                                            </h3>
                                            <p class="ml-4">Rp {{ number_format($subtotal, 0, ',', '.') }}</p>
                                        </div>
                                        <p class="mt-1 text-sm text-gray-500">{{ $item->produk->kategori->Nama_Kategori ?? 'Umum' }}</p>
                                    </div>
                                    <div class="flex-1 flex items-end justify-between text-sm">
                                        <p class="text-gray-500">Qty {{ $item->jumlah }} x Rp {{ number_format($item->produk->Harga, 0, ',', '.') }}</p>

                                        <div class="flex">
                                            <form action="{{ route('keranjang.destroy', $item->ID_DetailKeranjang) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="font-medium text-red-600 hover:text-red-500">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="w-full lg:w-1/3">
                <div class="bg-gray-50 rounded-lg border border-gray-200 p-6 sticky top-8">
                    <h2 class="text-lg font-medium text-gray-900">Ringkasan Pesanan</h2>
                    
                    <dl class="mt-6 space-y-4">
                        <div class="flex items-center justify-between border-t border-gray-200 pt-4">
                            <dt class="text-base font-medium text-gray-900">Total Harga</dt>
                            <dd class="text-base font-medium text-gray-900">Rp {{ number_format($totalBelanja, 0, ',', '.') }}</dd>
                        </div>
                    </dl>

                    <div class="mt-6">
                        <a href="{{ route('checkout.index') }}" class="w-full flex justify-center items-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-black hover:bg-gray-800 transition">
                            Checkout
                        </a>
                    </div>
                    
                    <div class="mt-6 flex justify-center text-sm text-center text-gray-500">
                        <p>
                            atau <a href="{{ route('produk.index') }}" class="text-black font-medium hover:underline">Lanjut Belanja<span aria-hidden="true"> &rarr;</span></a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection