@extends('layouts.app')

@section('title', 'Daftar Akun Baru')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl w-full bg-white rounded-2xl shadow-xl overflow-hidden flex flex-row-reverse">
        
        <div class="hidden md:block md:w-1/2 bg-black relative">
            <img src="https://images.unsplash.com/photo-1483985988355-763728e1935b?auto=format&fit=crop&q=80" 
                 alt="Register" 
                 class="absolute inset-0 w-full h-full object-cover opacity-80">
            <div class="absolute inset-0 flex items-center justify-center">
                <div class="text-center text-white px-6">
                    <h2 class="text-3xl font-bold mb-2">Gabung Bersama Kami</h2>
                    <p class="text-gray-200">Dapatkan akses ke koleksi eksklusif.</p>
                </div>
            </div>
        </div>

        <div class="w-full md:w-1/2 p-8 md:p-12">
            <div class="text-center mb-8">
                <h2 class="text-2xl font-bold text-gray-900">Buat Akun Baru</h2>
                <p class="text-gray-500 text-sm mt-2">Lengkapi data diri kamu di bawah ini</p>
            </div>

            @if ($errors->any())
                <div class="mb-4 bg-red-50 text-red-500 text-sm p-3 rounded-md">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register.process') }}" method="POST" class="space-y-4">
                @csrf
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                    <input type="text" name="Nama" required value="{{ old('Nama') }}"
                           class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-black focus:border-black sm:text-sm">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="Email" required value="{{ old('Email') }}"
                           class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-black focus:border-black sm:text-sm">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                    <input type="text" name="Telepon" required value="{{ old('Telepon') }}"
                           class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-black focus:border-black sm:text-sm">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" required
                           class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-black focus:border-black sm:text-sm">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" required
                           class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-black focus:border-black sm:text-sm">
                </div>

                <div class="pt-2">
                    <button type="submit" 
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-black hover:bg-gray-800 transition">
                        Daftar Sekarang
                    </button>
                </div>
            </form>

            <div class="mt-6 text-center text-sm">
                <p class="text-gray-500">
                    Sudah punya akun? 
                    <a href="{{ route('login') }}" class="font-medium text-black hover:underline">Login disini</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection