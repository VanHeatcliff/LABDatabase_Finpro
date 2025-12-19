@extends('layouts.admin') 

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-4 text-gray-800">Manajemen Pesanan Masuk</h2>
    
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">ID Pesanan</th>
                    <th class="py-3 px-6 text-left">Pelanggan</th>
                    <th class="py-3 px-6 text-center">Tanggal</th>
                    <th class="py-3 px-6 text-center">Total</th>
                    <th class="py-3 px-6 text-center">Status</th>
                    <th class="py-3 px-6 text-center">Aksi (ACC)</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @foreach($pesanan as $item)
                <tr class="border-b border-gray-200 hover:bg-gray-50">
                    <td class="py-3 px-6 text-left font-bold">{{ $item->ID_Pesanan }}</td>
                    <td class="py-3 px-6 text-left">
                        {{ $item->pelanggan->Nama ?? 'Guest' }} <br>
                        <span class="text-xs text-gray-400">{{ $item->Alamat_Pengiriman }}</span>
                    </td>
                    <td class="py-3 px-6 text-center">{{ \Carbon\Carbon::parse($item->Tanggal_Pesan)->format('d M Y') }}</td>
                    <td class="py-3 px-6 text-center">Rp {{ number_format($item->Total_Harga, 0, ',', '.') }}</td>
                    <td class="py-3 px-6 text-center">
                        @if($item->Status_Pesanan == 'Diproses')
                            <span class="bg-yellow-200 text-yellow-700 py-1 px-3 rounded-full text-xs">Baru Masuk</span>
                        @elseif($item->Status_Pesanan == 'Menunggu Verifikasi')
                            <span class="bg-blue-200 text-blue-700 py-1 px-3 rounded-full text-xs font-bold">Sudah Bayar</span>
                        @elseif($item->Status_Pesanan == 'Dikirim')
                            <span class="bg-green-200 text-green-700 py-1 px-3 rounded-full text-xs">Sedang Dikirim</span>
                        @else
                            <span class="bg-gray-200 text-gray-700 py-1 px-3 rounded-full text-xs">{{ $item->Status_Pesanan }}</span>
                        @endif
                    </td>
                    <td class="py-3 px-6 text-center">
                        <div class="flex item-center justify-center gap-2">
                            
                            {{-- <a href="{{ route('admin.pesanan.show', $item->ID_Pesanan) }}" class="text-blue-500 hover:text-blue-700">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                            </a> --}}

                            @if($item->Status_Pesanan != 'Dikirim' && $item->Status_Pesanan != 'Selesai')
                                <form action="{{ route('admin.pesanan.update', $item->ID_Pesanan) }}" method="POST" onsubmit="return confirm('Kirim pesanan ini?')">
                                    @csrf
                                    <input type="hidden" name="status_baru" value="Dikirim">
                                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-1 px-3 rounded text-xs flex items-center gap-1">
                                        <span>ACC / Kirim</span>
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    </button>
                                </form>
                            @else
                                <span class="text-green-500 text-xs font-bold">Selesai/Dikirim</span>
                            @endif

                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection