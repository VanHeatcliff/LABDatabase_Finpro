@extends('layouts.admin')

@section('header', 'Manajemen Produk')

@section('content')
<div class="bg-white rounded shadow p-6 mb-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold">Daftar Produk</h2>
        <a href="{{ route('admin.produk.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-sm transition">
            <i class="fas fa-plus mr-2"></i> Tambah Produk
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 relative" role="alert">
            <strong class="font-bold">Berhasil!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">ID</th>
                    <th class="py-3 px-6 text-left">Gambar</th>
                    <th class="py-3 px-6 text-left">Nama Produk</th>
                    <th class="py-3 px-6 text-left">Kategori</th>
                    <th class="py-3 px-6 text-right">Harga</th>
                    <th class="py-3 px-6 text-center">Stok</th>
                    <th class="py-3 px-6 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @forelse($produk as $p)
                <tr class="border-b border-gray-200 hover:bg-gray-50">
                    <td class="py-3 px-6 text-left whitespace-nowrap">
                        <span class="font-medium">{{ $p->ID_Produk }}</span>
                    </td>
                    <td class="py-3 px-6 text-left">
                        <img src="{{ asset($p->gambar_url) }}" alt="{{ $p->Nama_Produk }}" class="w-12 h-12 rounded object-cover shadow">
                    </td>
                    <td class="py-3 px-6 text-left">
                        <span>{{ $p->Nama_Produk }}</span>
                    </td>
                    <td class="py-3 px-6 text-left">
                        <span>{{ $p->kategori->Nama_Kategori ?? '-' }}</span>
                    </td>
                    <td class="py-3 px-6 text-right">
                        <span>Rp {{ number_format($p->Harga, 0, ',', '.') }}</span>
                    </td>
                    <td class="py-3 px-6 text-center">
                        <span class="{{ $p->Stok > 0 ? 'text-green-600' : 'text-red-600 font-bold' }}">
                            {{ $p->Stok }}
                        </span>
                    </td>
                    <td class="py-3 px-6 text-center">
                        <div class="flex item-center justify-center space-x-2">
                            <!-- Tombol ini bisa diaktifkan nanti kalau fiturnya sudah ada -->
                            <button disabled class="w-8 h-8 rounded-full bg-yellow-100 text-yellow-600 opacity-50 cursor-not-allowed">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button disabled class="w-8 h-8 rounded-full bg-red-100 text-red-600 opacity-50 cursor-not-allowed">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="py-6 px-6 text-center text-gray-500">
                        Belum ada data produk.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="mt-4">
        {{ $produk->links() }}
    </div>
</div>
@endsection
