@props(['produk'])

<div class="group relative bg-white border border-gray-200 rounded-lg overflow-hidden shadow-sm hover:shadow-lg transition-shadow duration-300">
    <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden bg-gray-200 xl:aspect-w-7 xl:aspect-h-8">
        <img src="{{ $produk->gambar_url ?? 'https://via.placeholder.com/400' }}" 
             alt="{{ $produk->Nama_Produk }}" 
             class="h-full w-full object-cover object-center group-hover:opacity-75 transition-opacity">
        
        <span class="absolute top-2 left-2 bg-black text-white text-xs px-2 py-1 rounded">
            {{ $produk->kategori->Nama_Kategori ?? 'Umum' }}
        </span>
    </div>

    <div class="p-4">
        <p class="text-xs text-gray-400 mb-1">Ref: {{ $produk->ID_Produk }}</p>

        <h3 class="mt-1 text-lg font-semibold text-gray-900 truncate">
            <a href="{{ route('produk.show', $produk->ID_Produk) }}">
                <span class="absolute inset-0"></span>
                {{ $produk->Nama_Produk }}
            </a>
        </h3>
        
        <div class="mt-2 flex items-center justify-between">
            <p class="text-xl font-bold text-gray-900">Rp {{ number_format($produk->Harga, 0, ',', '.') }}</p>
            
            <form action="{{ route('keranjang.add') }}" method="POST" class="relative z-10">
                @csrf
                <input type="hidden" name="id_produk" value="{{ $produk->ID_Produk }}">
                <button type="submit" class="p-2 bg-black text-white rounded-full hover:bg-gray-800 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </button>
            </form>
        </div>
    </div>
</div>