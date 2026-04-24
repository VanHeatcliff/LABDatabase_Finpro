@extends('layouts.app')

@section('content')

<style>
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-15px); }
        100% { transform: translateY(0px); }
    }
    .animate-fade-in-up {
        animation: fadeInUp 1s ease-out forwards;
        opacity: 0;
    }
    .animate-float {
        animation: float 6s ease-in-out infinite;
    }
    .animate-float-delayed {
        animation: float 6s ease-in-out 3s infinite;
    }
    .delay-100 { animation-delay: 100ms; }
    .delay-200 { animation-delay: 200ms; }
    .delay-300 { animation-delay: 300ms; }
    .delay-400 { animation-delay: 400ms; }
    .delay-500 { animation-delay: 500ms; }
</style>

<!-- Hero Section -->
<div class="relative bg-zinc-50 overflow-hidden mb-24 rounded-[3rem] shadow-sm border border-zinc-100">
    <!-- Decorative blobs/gradients -->
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0 pointer-events-none">
        <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] rounded-full bg-indigo-100/50 blur-[100px]"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[50%] h-[50%] rounded-full bg-rose-100/40 blur-[120px]"></div>
    </div>

    <div class="relative z-10 pt-20 pb-20 sm:pt-28 sm:pb-24 lg:pt-36 lg:pb-32 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="lg:grid lg:grid-cols-12 lg:gap-8 items-center">
            <!-- Text Content -->
            <div class="sm:text-center md:max-w-2xl md:mx-auto lg:col-span-5 lg:text-left lg:mr-auto">
                <span class="animate-fade-in-up inline-block py-1 px-3 rounded-full bg-zinc-900/5 text-zinc-800 text-sm font-semibold tracking-wider uppercase mb-6 border border-zinc-200">
                    Koleksi Terbaru
                </span>
                <h1 class="animate-fade-in-up delay-100 text-5xl font-extrabold tracking-tight text-zinc-900 sm:text-6xl lg:text-6xl xl:text-7xl leading-[1.1]">
                    Gaya Musim Ini <br> 
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-zinc-600 to-zinc-400 font-serif italic">Akhirnya Tiba</span>
                </h1>
                <p class="animate-fade-in-up delay-200 mt-6 text-lg text-zinc-600 font-light leading-relaxed">
                    Temukan koleksi pakaian terbaru dengan bahan berkualitas tinggi. Tampil percaya diri dengan desain eksklusif kami yang dirancang khusus untuk Anda.
                </p>
                <div class="animate-fade-in-up delay-300 mt-10 sm:flex sm:justify-center lg:justify-start">
                    <a href="{{ route('produk.index') }}" class="group relative flex items-center justify-center px-8 py-4 text-base font-medium text-white bg-zinc-900 rounded-full overflow-hidden transition-transform hover:scale-105 hover:shadow-2xl hover:shadow-zinc-900/20">
                        <span class="absolute inset-0 w-full h-full bg-gradient-to-r from-zinc-800 to-zinc-900 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                        <span class="relative flex items-center gap-2">
                            Belanja Sekarang
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </span>
                    </a>
                </div>
            </div>
            
            <!-- Images Grid -->
            <div class="animate-fade-in-up delay-400 mt-16 sm:mt-24 lg:mt-0 lg:col-span-7 relative">
                <div class="relative w-full max-w-lg mx-auto lg:max-w-none">
                    <div class="grid grid-cols-2 gap-4 md:gap-6 relative z-10">
                        <!-- Column 1 -->
                        <div class="space-y-4 md:space-y-6 pt-12">
                            <div class="animate-float rounded-3xl overflow-hidden shadow-2xl border-4 border-white">
                                <img src="https://i.pinimg.com/474x/61/fe/bb/61febb04c2f883d6b53eb7a9074ff911.jpg" alt="Fashion 1" class="w-full h-56 md:h-72 object-cover hover:scale-110 transition-transform duration-700">
                            </div>
                            <div class="animate-float-delayed rounded-3xl overflow-hidden shadow-2xl border-4 border-white">
                                <img src="https://images.pexels.com/photos/18368140/pexels-photo-18368140.jpeg" alt="Fashion 2" class="w-full h-64 md:h-80 object-cover hover:scale-110 transition-transform duration-700">
                            </div>
                        </div>
                        <!-- Column 2 -->
                        <div class="space-y-4 md:space-y-6">
                            <div class="animate-float-delayed rounded-3xl overflow-hidden shadow-2xl border-4 border-white">
                                <img src="https://wimg.mk.co.kr/news/cms/202502/28/news-p.v1.20250228.e815bfda4cd5472da70464d10b15c1a9_P1.jpg" alt="Fashion 3" class="w-full h-64 md:h-80 object-cover hover:scale-110 transition-transform duration-700">
                            </div>
                            <div class="animate-float rounded-3xl overflow-hidden shadow-2xl border-4 border-white">
                                <img src="https://images.pexels.com/photos/29096397/pexels-photo-29096397.jpeg" alt="Fashion 4" class="w-full h-56 md:h-72 object-cover hover:scale-110 transition-transform duration-700">
                            </div>
                        </div>
                    </div>
                    <!-- Background aesthetic blob for images -->
                    <div class="absolute inset-0 bg-gradient-to-tr from-zinc-200 to-zinc-100 rounded-full blur-3xl opacity-50 transform scale-110 z-0"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Brands / Feature Banner -->
<div class="animate-fade-in-up delay-500 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-24">
    <div class="bg-white rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-zinc-100 p-8 md:p-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center divide-y md:divide-y-0 md:divide-x divide-zinc-100">
            <div class="p-4 group">
                <div class="w-14 h-14 mx-auto bg-zinc-50 rounded-2xl flex items-center justify-center mb-5 group-hover:scale-110 group-hover:bg-zinc-900 group-hover:text-white transition-all duration-300 text-zinc-800">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path></svg>
                </div>
                <h3 class="font-bold text-zinc-900 text-lg mb-2">Kualitas Premium</h3>
                <p class="text-zinc-500 text-sm leading-relaxed">Material eksklusif untuk kenyamanan maksimal dan ketahanan jangka panjang.</p>
            </div>
            <div class="p-4 group">
                <div class="w-14 h-14 mx-auto bg-zinc-50 rounded-2xl flex items-center justify-center mb-5 group-hover:scale-110 group-hover:bg-zinc-900 group-hover:text-white transition-all duration-300 text-zinc-800">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="font-bold text-zinc-900 text-lg mb-2">Desain Eksklusif</h3>
                <p class="text-zinc-500 text-sm leading-relaxed">Dirancang oleh desainer profesional untuk menciptakan gaya yang tak lekang oleh waktu.</p>
            </div>
            <div class="p-4 group">
                <div class="w-14 h-14 mx-auto bg-zinc-50 rounded-2xl flex items-center justify-center mb-5 group-hover:scale-110 group-hover:bg-zinc-900 group-hover:text-white transition-all duration-300 text-zinc-800">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                </div>
                <h3 class="font-bold text-zinc-900 text-lg mb-2">Pembayaran Aman</h3>
                <p class="text-zinc-500 text-sm leading-relaxed">Sistem transaksi yang terenkripsi dan jaminan keamanan 100% untuk setiap pesanan.</p>
            </div>
        </div>
    </div>
</div>

<!-- Categories Section -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-24">
    <div class="flex flex-col md:flex-row md:items-end justify-between mb-12">
        <div class="max-w-2xl">
            <h2 class="text-3xl md:text-4xl font-extrabold tracking-tight text-zinc-900 mb-4">Belanja Berdasarkan Kategori</h2>
            <p class="text-zinc-500 text-lg">Temukan gaya personal Anda melalui kurasi kategori terbaik kami.</p>
        </div>
        <a href="{{ route('produk.index') }}" class="mt-4 md:mt-0 hidden sm:inline-flex items-center text-sm font-bold text-zinc-900 hover:text-zinc-600 transition-colors group">
            Lihat Semua Koleksi
            <span class="w-8 h-px bg-zinc-900 ml-3 transition-all group-hover:w-12"></span>
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">
        <!-- Pria -->
        <a href="{{ route('produk.index') }}?kategori=pria" class="group relative rounded-3xl overflow-hidden h-[30rem] cursor-pointer block">
            <div class="absolute inset-0 bg-zinc-200">
                <img src="https://images.unsplash.com/photo-1617137968427-85924c800a22?auto=format&fit=crop&q=80&w=800" alt="Kategori Pria" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110">
            </div>
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-70 group-hover:opacity-80 transition-opacity duration-500"></div>
            
            <div class="absolute bottom-0 left-0 right-0 p-8 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                <h3 class="text-white text-3xl font-extrabold mb-3">Pria</h3>
                <div class="overflow-hidden">
                    <p class="text-zinc-300 transform translate-y-full opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-500 ease-out delay-100">
                        Koleksi pakaian pria untuk tampilan maskulin, kasual, hingga formal yang elegan.
                    </p>
                </div>
            </div>
        </a>

        <!-- Wanita -->
        <a href="{{ route('produk.index') }}?kategori=wanita" class="group relative rounded-3xl overflow-hidden h-[30rem] cursor-pointer block">
            <div class="absolute inset-0 bg-zinc-200">
                <img src="https://images.unsplash.com/photo-1525507119028-ed4c629a60a3?auto=format&fit=crop&q=80&w=800" alt="Kategori Wanita" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110">
            </div>
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-70 group-hover:opacity-80 transition-opacity duration-500"></div>
            
            <div class="absolute bottom-0 left-0 right-0 p-8 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                <h3 class="text-white text-3xl font-extrabold mb-3">Wanita</h3>
                <div class="overflow-hidden">
                    <p class="text-zinc-300 transform translate-y-full opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-500 ease-out delay-100">
                        Pancarkan pesona dengan desain anggun, modern, dan trendi untuk setiap kesempatan.
                    </p>
                </div>
            </div>
        </a>

        <!-- Aksesoris -->
        <a href="{{ route('produk.index') }}?kategori=aksesoris" class="group relative rounded-3xl overflow-hidden h-[30rem] cursor-pointer block">
            <div class="absolute inset-0 bg-zinc-200">
                <img src="https://images.unsplash.com/photo-1596870230751-ebdfce98ec42?auto=format&fit=crop&q=80&w=800" alt="Kategori Aksesoris" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110">
            </div>
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-70 group-hover:opacity-80 transition-opacity duration-500"></div>
            
            <div class="absolute bottom-0 left-0 right-0 p-8 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                <h3 class="text-white text-3xl font-extrabold mb-3">Aksesoris</h3>
                <div class="overflow-hidden">
                    <p class="text-zinc-300 transform translate-y-full opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-500 ease-out delay-100">
                        Sempurnakan gaya Anda dengan sentuhan aksesoris premium kami.
                    </p>
                </div>
            </div>
        </a>
    </div>
</div>

@endsection