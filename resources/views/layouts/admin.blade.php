<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - ClothingStore</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100 font-sans antialiased">

    <div class="flex h-screen overflow-hidden">
        
        <aside class="w-64 bg-gray-900 text-white flex flex-col shadow-xl">
            <div class="h-16 flex items-center justify-center border-b border-gray-800">
                <h1 class="text-xl font-bold uppercase tracking-wider">ADMIN <span class="text-red-500">STORE</span></h1>
            </div>

            <nav class="flex-1 px-2 py-4 space-y-2 overflow-y-auto">
                
                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-red-600 text-white' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                    <i class="fas fa-tachometer-alt w-6"></i>
                    <span class="font-medium">Dashboard</span>
                </a>

                <a href="{{ route('admin.pesanan.index') }}" 
                   class="flex items-center px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('admin.pesanan.*') ? 'bg-red-600 text-white' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                    <i class="fas fa-shopping-cart w-6"></i>
                    <span class="font-medium">Pesanan</span>
                </a>

                <a href="{{ route('admin.produk.index') }}" 
                   class="flex items-center px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('admin.produk.*') ? 'bg-red-600 text-white' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                    <i class="fas fa-box w-6"></i>
                    <span class="font-medium">Produk</span>
                </a>

                <div class="border-t border-gray-800 my-2"></div>

                <a href="{{ route('home') }}" target="_blank"
                   class="flex items-center px-4 py-3 rounded-lg text-gray-400 hover:bg-gray-800 hover:text-white transition-colors">
                    <i class="fas fa-external-link-alt w-6"></i>
                    <span class="font-medium">Lihat Website</span>
                </a>
            </nav>

            <div class="p-4 border-t border-gray-800 bg-gray-900">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-red-500 flex items-center justify-center text-xs font-bold">
                        {{ substr(Auth::guard('admin')->user()->Nama_Admin ?? 'A', 0, 1) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-white truncate">
                            {{ Auth::guard('admin')->user()->Nama_Admin ?? 'Admin' }}
                        </p>
                        <p class="text-xs text-gray-400 truncate">
                            {{ Auth::guard('admin')->user()->Role_Admin ?? 'Super Admin' }}
                        </p>
                    </div>
                </div>
            </div>
        </aside>

        <div class="flex-1 flex flex-col h-screen overflow-hidden">
            
            <header class="bg-white shadow-sm h-16 flex items-center justify-between px-6 z-10">
                <h2 class="text-xl font-semibold text-gray-800">
                    @yield('header', 'Admin Area')
                </h2>

                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium flex items-center gap-2">
                        <span>Logout</span>
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                </form>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
                @yield('content')
            </main>

        </div>
    </div>

</body>
</html>