@extends('layouts.app')

@section('title', 'Detail Pesanan #' . $pesanan->ID_Pesanan)

@section('content')
<div class="max-w-4xl mx-auto px-4 py-10">
    <div class="mb-6">
        <a href="{{ route('pesanan.index') }}" class="text-sm text-gray-500 hover:text-black">&larr; Kembali ke Riwayat</a>
    </div>

    <div class="bg-white shadow overflow-hidden sm:rounded-lg border border-gray-200">
        <div class="px-4 py-5 sm:px-6 flex justify-between items-center bg-gray-50">
            <div>
                <h3 class="text-lg leading-6 font-medium text-gray-900">Invoice #{{ $pesanan->ID_Pesanan }}</h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">Dipesan pada {{ \Carbon\Carbon::parse($pesanan->Tanggal_Pesan)->translatedFormat('d F Y') }}</p>
            </div>
            <span class="px-3 py-1 rounded-md text-sm font-bold bg-black text-white">
                {{ $pesanan->Status_Pesanan }}
            </span>
        </div>
        
        <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
            <dl class="sm:divide-y sm:divide-gray-200">
                
                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Alamat Pengiriman</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $pesanan->alamat->Alamat_Lengkap }}<br>
                        {{ $pesanan->alamat->Kota }}, {{ $pesanan->alamat->Kode_Pos }}
                    </dd>
                </div>

                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Metode Pembayaran</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $pesanan->pembayaran->metode->Nama_Metode ?? '-' }} 
                        (Status: {{ $pesanan->pembayaran->Jumlah_Bayar ? 'Lunas' : 'Belum Dibayar' }})
                    </dd>
                </div>

                <div class="py-4 sm:py-5 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500 mb-4">Item Pesanan</dt>
                    <ul class="border border-gray-200 rounded-md divide-y divide-gray-200">
                        @foreach($pesanan->details as $item)
                        <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                            <div class="w-0 flex-1 flex items-center">
                                <span class="ml-2 flex-1 w-0 truncate">
                                    {{ $item->produk->Nama_Produk }} 
                                    <span class="text-gray-500">x {{ $item->Jumlah }}</span>
                                </span>
                            </div>
                            <div class="ml-4 flex-shrink-0 font-medium">
                                Rp {{ number_format($item->Harga_Satuan * $item->Jumlah, 0, ',', '.') }}
                            </div>
                        </li>
                        @endforeach
                        
                        <li class="pl-3 pr-4 py-3 flex items-center justify-between text-base font-bold bg-gray-50">
                            <span class="ml-2">Total Bayar</span>
                            <span class="ml-4">Rp {{ number_format($pesanan->Total_Harga, 0, ',', '.') }}</span>
                        </li>
                    </ul>
                </div>
            </dl>
        </div>
    </div>
</div>
@endsection