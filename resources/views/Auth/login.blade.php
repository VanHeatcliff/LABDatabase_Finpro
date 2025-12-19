@extends('layouts.app')

@section('title', 'Login Pelanggan')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl w-full bg-white rounded-2xl shadow-xl overflow-hidden flex">
        
        <div class="hidden md:block md:w-1/2 bg-black relative">
            <img src="https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?auto=format&fit=crop&q=80" 
                 alt="Fashion" 
                 class="absolute inset-0 w-full h-full object-cover opacity-80">
            <div class="absolute inset-0 flex items-center justify-center">
                <div class="text-center text-white px-6">
                    <h2 class="text-3xl font-bold mb-2">Welcome Back!</h2>
                    <p class="text-gray-200">Temukan gaya terbaikmu hari ini.</p>
                </div>
            </div>
        </div>

        <div class="w-full md:w-1/2 p-8 md:p-12">
            <div class="text-center mb-8">
                <h2 class="text-2xl font-bold text-gray-900">Masuk Akun</h2>
                <p class="text-gray-500 text-sm mt-2">Silakan login untuk mulai berbelanja</p>
            </div>

            @if ($errors->any())
                <div class="mb-4 bg-red-50 text-red-500 text-sm p-3 rounded-md">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('login.process') }}" method="POST" class="space-y-6">
                @csrf
                
                <div>
                    <label for="Email" class="block text-sm font-medium text-gray-700">Alamat Email</label>
                    <input type="email" name="Email" id="Email" required 
                           class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-black focus:border-black sm:text-sm"
                           placeholder="nama@email.com">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" id="password" required 
                           class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-black focus:border-black sm:text-sm"
                           placeholder="••••••••">
                </div>

                <div>
                    <button type="submit" 
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-black hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-black transition">
                        Masuk Sekarang
                    </button>
                </div>
            </form>

            <div class="mt-6 text-center text-sm">
                <p class="text-gray-500">
                    Belum punya akun? 
                    <a href="#" class="font-medium text-black hover:underline">Daftar disini</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection