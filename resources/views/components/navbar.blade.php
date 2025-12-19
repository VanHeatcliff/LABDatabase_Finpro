<nav class="bg-white border-b border-gray-200 sticky top-0 z-50" x-data="{ mobileMenuOpen: false, profileOpen: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            
            <div class="flex">
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="text-2xl font-bold tracking-tighter uppercase">
                        CLOTHING<span class="text-gray-500">STORE</span>
                    </a>
                </div>
                
                <div class="hidden sm:ml-8 sm:flex sm:space-x-8">
                    <a href="{{ route('home') }}" 
                       class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium {{ request()->routeIs('home') ? 'border-black text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                        Home
                    </a>
                    <a href="{{ route('produk.index') }}" 
                       class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium {{ request()->routeIs('produk.*') ? 'border-black text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                        Katalog
                    </a>
                </div>
            </div>

            <div class="hidden sm:ml-6 sm:flex sm:items-center space-x-6">
                
                <div class="mr-4">
                    @auth('admin')
                        <a href="{{ route('admin.dashboard') }}" class="px-3 py-1 text-xs font-bold text-red-600 border border-red-600 rounded hover:bg-red-600 hover:text-white transition">
                            Dashboard Admin
                        </a>
                    @else
                        <a href="{{ route('admin.login') }}" class="text-xs text-gray-400 hover:text-gray-800 transition">
                            Admin
                        </a>
                    @endauth
                </div>
                @auth('pelanggan')
                    <a href="{{ route('keranjang.index') }}" class="group -m-2 p-2 flex items-center relative">
                        <svg class="flex-shrink-0 h-6 w-6 text-gray-400 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        
                        @php
                            $cartCount = 0;
                            $user = Auth::guard('pelanggan')->user();
                            if($user && $user->keranjang) {
                                $cartCount = $user->keranjang->details->sum('Jumlah');
                            }
                        @endphp

                        @if($cartCount > 0)
                            <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">
                                {{ $cartCount }}
                            </span>
                        @endif
                    </a>

                    <div class="ml-3 relative">
                        <div>
                            <button @click="profileOpen = !profileOpen" @click.away="profileOpen = false" type="button" class="bg-white flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-black">
                                <span class="sr-only">Open user menu</span>
                                <span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-black text-white font-bold">
                                    {{ substr(Auth::guard('pelanggan')->user()->Nama, 0, 1) }}
                                </span>
                                <span class="ml-2 text-sm font-medium text-gray-700">{{ Auth::guard('pelanggan')->user()->Nama }}</span>
                                <svg class="ml-1 h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>

                        <div x-show="profileOpen" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" 
                             style="display: none;">
                            
                            <div class="px-4 py-2 border-b">
                                <p class="text-xs text-gray-500">Login sebagai</p>
                                <p class="text-sm font-bold text-gray-900 truncate">{{ Auth::guard('pelanggan')->user()->Email }}</p>
                            </div>

                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profil Saya</a>
                            <a href="{{ route('pesanan.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Riwayat Pesanan</a>
                            
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left block px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                    Keluar (Logout)
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('login') }}" class="text-sm font-medium text-gray-500 hover:text-gray-900">Masuk</a>
                        <a href="{{ route('register') }}" class="ml-2 inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-black hover:bg-gray-800">
                            Daftar
                        </a>
                    </div>
                @endauth
            </div>

            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="mobileMenuOpen = !mobileMenuOpen" type="button" class="bg-white inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-black">
                    <span class="sr-only">Open main menu</span>
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div x-show="mobileMenuOpen" class="sm:hidden" style="display: none;">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('home') }}" class="bg-gray-50 border-black text-black block pl-3 pr-4 py-2 border-l-4 text-base font-medium">Home</a>
            <a href="{{ route('produk.index') }}" class="border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700 block pl-3 pr-4 py-2 border-l-4 text-base font-medium">Katalog</a>
        </div>
        
        <div class="pt-4 pb-4 border-t border-gray-200">
            <div class="px-4 mb-4">
                @auth('admin')
                    <a href="{{ route('admin.dashboard') }}" class="block text-center w-full px-4 py-2 border border-red-500 rounded-md shadow-sm text-sm font-medium text-red-600 bg-white hover:bg-red-50">
                        Dashboard Admin
                    </a>
                @else
                    <a href="{{ route('admin.login') }}" class="block text-center w-full text-xs text-gray-400 hover:text-gray-600">
                        Login Admin
                    </a>
                @endauth
            </div>
            @auth('pelanggan')
                <div class="flex items-center px-4">
                    <div class="flex-shrink-0">
                        <span class="inline-flex items-center justify-center h-10 w-10 rounded-full bg-black text-white font-bold">
                            {{ substr(Auth::guard('pelanggan')->user()->Nama, 0, 1) }}
                        </span>
                    </div>
                    <div class="ml-3">
                        <div class="text-base font-medium text-gray-800">{{ Auth::guard('pelanggan')->user()->Nama }}</div>
                        <div class="text-sm font-medium text-gray-500">{{ Auth::guard('pelanggan')->user()->Email }}</div>
                    </div>
                </div>
                <div class="mt-3 space-y-1">
                    <a href="#" class="block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100">Profil Saya</a>
                    <a href="{{ route('pesanan.index') }}" class="block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100">Riwayat Pesanan</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left block px-4 py-2 text-base font-medium text-red-600 hover:bg-gray-100">Keluar</button>
                    </form>
                </div>
            @else
                <div class="mt-3 space-y-1 px-4">
                    <a href="{{ route('login') }}" class="block w-full text-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">Masuk</a>
                    <a href="{{ route('register') }}" class="mt-2 block w-full text-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-black hover:bg-gray-800">Daftar</a>
                </div>
            @endauth
        </div>
    </div>
</nav>