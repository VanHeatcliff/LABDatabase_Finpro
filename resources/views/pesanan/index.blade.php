@extends('layouts.app')

@section('title', 'Riwayat Pesanan Saya')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <h1 class="text-3xl font-bold mb-8">Riwayat Pesanan</h1>

    @if($pesanan->isEmpty())
        <div class="text-center py-12 bg-white rounded-lg border border-gray-200">
            <p class="text-gray-500 text-lg">Kamu belum pernah berbelanja.</p>
            <a href="{{ route('produk.index') }}" class="mt-4 inline-block text-black font-semibold hover:underline">Mulai Belanja &rarr;</a>
        </div>
    @else
        <div class="space-y-6">
            @foreach($pesanan as $order)
                <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden hover:shadow-md transition">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <p class="text-sm text-gray-500">No. Pesanan</p>
                                <p class="font-bold text-lg font-mono">{{ $order->ID_Pesanan }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm text-gray-500">Tanggal</p>
                                <p class="font-medium">{{ \Carbon\Carbon::parse($order->Tanggal_Pesan)->format('d M Y') }}</p>
                            </div>
                        </div>

                        <div class="flex items-center justify-between border-t border-gray-100 pt-4">
                            <div>
                                <p class="text-sm text-gray-500">Total Belanja</p>
                                <p class="font-bold text-black">Rp {{ number_format($order->Total_Harga, 0, ',', '.') }}</p>
                            </div>
                            
                            <div>
                                @php
                                    $statusClass = match($order->Status_Pesanan) {
                                        'Pending' => 'bg-yellow-100 text-yellow-800',
                                        'Diproses' => 'bg-blue-100 text-blue-800',
                                        'Dikirim' => 'bg-indigo-100 text-indigo-800',
                                        'Selesai' => 'bg-green-100 text-green-800',
                                        'Batal' => 'bg-red-100 text-red-800',
                                        default => 'bg-gray-100 text-gray-800'
                                    };
                                @endphp
                                <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $statusClass }}">
                                    {{ $order->Status_Pesanan }}
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-gray-50 px-6 py-3 flex justify-between items-center">
                        <span class="text-sm text-gray-500">{{ $order->details->count() }} Barang</span>
                        <a href="{{ route('pesanan.show', $order->ID_Pesanan) }}" class="text-sm font-medium text-black hover:text-gray-600">
                            Lihat Detail &rarr;
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection