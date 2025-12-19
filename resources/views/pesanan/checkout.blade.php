@extends('layouts.app')

@section('title', 'Checkout')

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Ada masalah!</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
            {{ session('error') }}
        </div>
    @endif
    
    <form action="{{ route('pesanan.store') }}" method="POST">
        @csrf
        <div class="flex flex-col lg:flex-row gap-8">
            
            <div class="w-full lg:w-2/3 space-y-8">
                
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">Alamat Pengiriman</h2>
                    
                    <div class="grid grid-cols-1 gap-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nama Penerima</label>
                            <input type="text" name="nama_penerima" value="{{ Auth::guard('pelanggan')->user()->Nama }}" 
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-black focus:border-black sm:text-sm bg-gray-100" readonly>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Alamat Lengkap</label>
                            <textarea name="alamat_pengiriman" rows="3" required placeholder="Nama Jalan, No Rumah, RT/RW"
                                      class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-black focus:border-black sm:text-sm"></textarea>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Kota</label>
                                <input type="text" name="kota" required
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-black focus:border-black sm:text-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Kode Pos</label>
                                <input type="text" name="kode_pos" required
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-black focus:border-black sm:text-sm">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">Metode Pembayaran</h2>
                    <div class="space-y-4">
                        
                        @forelse($metodeBayar as $item)
                            <div class="flex items-center">
                                <input id="metode_{{ $item->ID_Metode }}" 
                                       name="ID_Metode" 
                                       type="radio" 
                                       value="{{ $item->ID_Metode }}" 
                                       class="focus:ring-black h-4 w-4 text-black border-gray-300" 
                                       required>
                                
                                <label for="metode_{{ $item->ID_Metode }}" class="ml-3 block text-sm font-medium text-gray-700">
                                    {{ $item->Nama_Metode }} 
                                    </label>
                            </div>
                        @empty
                            <p class="text-red-500 text-sm">Belum ada metode pembayaran tersedia.</p>
                        @endforelse

                    </div>
                </div>
            </div>

            <div class="w-full lg:w-1/3">
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 sticky top-8">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">Ringkasan Pesanan</h2>
                    
                    <ul class="divide-y divide-gray-200 mb-4">
                        @php $totalBayar = 0; @endphp
                        
                        @foreach($keranjang->details as $item)
                            @php 
                                // Pastikan pakai 'jumlah' (huruf kecil)
                                $subtotal = $item->produk->Harga * $item->jumlah; 
                                $totalBayar += $subtotal;
                            @endphp

                            <li class="py-4 flex">
                                <div class="flex-shrink-0 w-16 h-16 border border-gray-200 rounded-md overflow-hidden">
                                    <img src="{{ $item->produk->gambar ?? 'https://via.placeholder.com/100' }}" 
                                         class="w-full h-full object-cover">
                                </div>
                                <div class="ml-4 flex-1 flex flex-col justify-between">
                                    <div>
                                        <h3 class="text-sm font-medium text-gray-900">{{ $item->produk->Nama_Produk }}</h3>
                                        <p class="text-sm text-gray-500">Qty: {{ $item->jumlah }}</p> 
                                    </div>
                                    <p class="text-sm font-medium text-gray-900">Rp {{ number_format($subtotal, 0, ',', '.') }}</p>
                                </div>
                            </li>
                        @endforeach
                    </ul>

                    <div class="border-t border-gray-200 pt-4 space-y-2">
                        <div class="flex justify-between text-sm text-gray-600">
                            <p>Subtotal</p>
                            <p>Rp {{ number_format($totalBayar, 0, ',', '.') }}</p>
                        </div>
                        <div class="flex justify-between text-base font-medium text-gray-900 pt-2 border-t">
                            <p>Total Bayar</p>
                            <p>Rp {{ number_format($totalBayar, 0, ',', '.') }}</p>
                        </div>
                    </div>

                    <input type="hidden" name="total_harga" value="{{ $keranjang->details->sum(fn($detail) => $detail->produk->Harga * $detail->jumlah) }}">

                    <button type="submit" class="mt-6 w-full bg-black border border-transparent rounded-md shadow-sm py-3 px-4 text-base font-medium text-white hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-black">
                        Konfirmasi Pesanan
                    </button>
                </div>
            </div>

        </div>
    </form>
</div>
@endsection