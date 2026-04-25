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

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 bg-white p-6 rounded shadow">
        <h2 class="text-xl font-bold mb-4">Grafik Penjualan 7 Hari Terakhir</h2>
        <canvas id="salesChart" height="100"></canvas>
    </div>

    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-xl font-bold mb-4">Selamat Datang</h2>
        <p>Halo, {{ Auth::guard('admin')->user()->Nama_Admin ?? 'Admin' }}! Selamat bekerja di Admin Panel.</p>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($chartLabels) !!},
                datasets: [{
                    label: 'Pendapatan (Rp)',
                    data: {!! json_encode($chartData) !!},
                    backgroundColor: 'rgba(220, 38, 38, 0.5)', // red-600 with opacity
                    borderColor: 'rgba(220, 38, 38, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value, index, values) {
                                return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
                            }
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed.y !== null) {
                                    label += 'Rp ' + new Intl.NumberFormat('id-ID').format(context.parsed.y);
                                }
                                return label;
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endsection