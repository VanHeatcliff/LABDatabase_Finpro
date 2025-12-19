@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-16 sm:px-6 sm:py-24 lg:px-8">
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        
        <div class="px-4 py-5 sm:px-6 text-center">
            <h3 class="text-2xl leading-6 font-medium text-gray-900">Pesanan Berhasil Dibuat!</h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500 mx-auto">
                Kode Pesanan: <span class="font-bold text-black">{{ $pesanan->ID_Pesanan }}</span>
            </p>
        </div>

        <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
            <dl class="sm:divide-y sm:divide-gray-200">
                
                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Total Tagihan</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 font-bold text-lg">
                        Rp {{ number_format($pesanan->Total_Harga, 0, ',', '.') }}
                    </dd>
                </div>

                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 bg-gray-50">
                    <dt class="text-sm font-medium text-gray-500">Metode Pembayaran</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ optional($pesanan->metodeBayar)->Nama_Metode ?? 'Transfer Bank' }}
                    </dd>
                </div>

                <div class="py-4 sm:py-5 sm:px-6">
                    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
                        <div class="flex">
                            <div class="ml-3">
                                <p class="text-sm text-yellow-700">
                                    Silakan transfer ke Nomor Rekening berikut:
                                </p>
                                <p class="text-lg font-bold text-gray-900 mt-1">
                                    BCA 123-456-7890 (a.n Toko Baju)
                                </p>
                                <p class="text-xs text-gray-500 mt-2">
                                    Setelah transfer, mohon klik tombol konfirmasi di bawah ini agar pesanan segera diproses.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </dl>
        </div>

        <div class="px-4 py-5 sm:px-6 text-center bg-gray-50">
            @if($pesanan->Status_Pesanan == 'Diproses' || $pesanan->Status_Pesanan == 'Pending')
                <form action="{{ route('pesanan.konfirmasi', $pesanan->ID_Pesanan) }}" method="POST">
                    @csrf
                    <button type="submit" onclick="return confirm('Apakah Anda yakin sudah melakukan transfer?')"
                        class="w-full inline-flex justify-center py-3 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Saya Sudah Membayar
                    </button>
                </form>
            @elseif($pesanan->Status_Pesanan == 'Menunggu Verifikasi')
                <div class="w-full py-3 px-4 bg-blue-100 text-blue-700 rounded-md">
                    Pembayaran sedang diverifikasi oleh Admin.
                </div>
            @else
                <div class="w-full py-3 px-4 bg-gray-100 text-gray-700 rounded-md">
                    Status: {{ $pesanan->Status_Pesanan }}
                </div>
            @endif
            
            <a href="{{ route('home') }}" class="block mt-4 text-sm text-blue-600 hover:text-blue-500">
                Kembali ke Beranda
            </a>
        </div>

    </div>
</div>
@endsection