@extends('layouts.admin')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
    <div class="bg-blue-100 p-4 rounded-lg border-l-4 border-blue-500 shadow">
        <h3 class="text-blue-800 text-sm font-bold">Total Pesanan</h3>
        <p class="text-2xl font-bold">{{ $totalPesanan }}</p>
    </div>

    <div class="bg-red-100 p-4 rounded-lg border-l-4 border-red-500 shadow">
        <h3 class="text-red-800 text-sm font-bold">Perlu Proses</h3>
        <p class="text-2xl font-bold">{{ $pesananPerluProses }}</p>
    </div>

    <div class="bg-green-100 p-4 rounded-lg border-l-4 border-green-500 shadow">
        <h3 class="text-green-800 text-sm font-bold">Total Pendapatan</h3>
        <p class="text-2xl font-bold">Rp {{ number_format($pendapatan, 0, ',', '.') }}</p>
    </div>

    <div class="bg-yellow-100 p-4 rounded-lg border-l-4 border-yellow-500 shadow">
        <h3 class="text-yellow-800 text-sm font-bold">Total Produk</h3>
        <p class="text-2xl font-bold">{{ $totalProduk }}</p>
    </div>
</div>

<div class="bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Selamat Datang di Admin Panel</h2>
    <p>Halo, {{ Auth::guard('admin')->user()->Nama_Admin ?? 'Admin' }}! Selamat bekerja.</p>
</div>
@endsection