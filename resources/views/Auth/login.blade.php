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

            <form action="{{ route('login.process') }}" method="POST" id="loginForm" class="space-y-6">
                @csrf
                
                <div id="emailSection">
                    <label for="Email" class="block text-sm font-medium text-gray-700">Alamat Email</label>
                    <input type="email" name="Email" id="Email" required value="{{ old('Email') }}"
                           class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-black focus:border-black sm:text-sm"
                           placeholder="nama@email.com">
                    
                    <button type="button" onclick="showPasswordPopup()" 
                            class="mt-6 w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-black hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-black transition">
                        Selanjutnya
                    </button>
                </div>

                <!-- Modal untuk Password & Remember Me -->
                <div id="passwordModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden flex items-center justify-center z-50 transition-opacity">
                    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-8 transform transition-all">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-xl font-bold text-gray-900">Masukkan Password</h3>
                            <button type="button" onclick="closePasswordPopup()" class="text-gray-400 hover:text-gray-500">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        
                        <div class="mb-4">
                            <p class="text-sm text-gray-500">Email Anda:</p>
                            <p id="displayEmail" class="font-medium text-gray-900"></p>
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                            <input type="password" name="password" id="password" 
                                   class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-black focus:border-black sm:text-sm"
                                   placeholder="••••••••">
                        </div>
                        
                        <div class="mt-4 flex items-center justify-between">
                            <div class="flex items-center">
                                <input id="remember" name="remember" type="checkbox" class="h-4 w-4 text-black focus:ring-black border-gray-300 rounded">
                                <label for="remember" class="ml-2 block text-sm text-gray-900">
                                    Ingat Sandi (Remember Me)
                                </label>
                            </div>
                        </div>

                        <div class="mt-6">
                            <button type="submit" 
                                    class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-black hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-black transition">
                                Masuk Sekarang
                            </button>
                        </div>
                    </div>
                </div>
            </form>

            <script>
                // Saat halaman dimuat, kita bisa mengisi otomatis email jika ada
                window.onload = function() {
                    const savedEmail = localStorage.getItem('clothing_store_email');
                    if (savedEmail && document.getElementById('Email').value === '') {
                        document.getElementById('Email').value = savedEmail;
                    }

                    // Jika ada error login (misal password salah), tampilkan modal password kembali
                    @if ($errors->any())
                        const emailInput = document.getElementById('Email');
                        if (emailInput.value !== '') {
                            document.getElementById('displayEmail').innerText = emailInput.value;
                            document.getElementById('passwordModal').classList.remove('hidden');
                            document.getElementById('password').setAttribute('required', 'required');
                            setTimeout(() => document.getElementById('password').focus(), 100);
                        }
                    @endif
                };

                function showPasswordPopup() {
                    const emailInput = document.getElementById('Email');
                    if (emailInput.checkValidity()) {
                        document.getElementById('displayEmail').innerText = emailInput.value;
                        
                        // Cek apakah email cocok dengan data di localStorage
                        const savedEmail = localStorage.getItem('clothing_store_email');
                        const savedPassword = localStorage.getItem('clothing_store_password');
                        
                        if (savedEmail && emailInput.value === savedEmail && savedPassword) {
                            // Isi otomatis password
                            document.getElementById('password').value = savedPassword;
                            document.getElementById('remember').checked = true;
                            
                            // Langsung submit ke proses login (direct ke laman home)
                            document.getElementById('loginForm').submit();
                            return; // Hentikan fungsi agar modal tidak muncul
                        }

                        // Jika tidak ada data tersimpan, tampilkan modal password
                        document.getElementById('passwordModal').classList.remove('hidden');
                        document.getElementById('password').setAttribute('required', 'required');
                        setTimeout(() => document.getElementById('password').focus(), 100);
                    } else {
                        emailInput.reportValidity();
                    }
                }

                function closePasswordPopup() {
                    document.getElementById('passwordModal').classList.add('hidden');
                    document.getElementById('password').removeAttribute('required');
                }

                // Tangkap proses submit untuk menyimpan data ke localStorage jika 'remember' dicentang
                document.getElementById('loginForm').addEventListener('submit', function() {
                    if (document.getElementById('remember').checked) {
                        localStorage.setItem('clothing_store_email', document.getElementById('Email').value);
                        localStorage.setItem('clothing_store_password', document.getElementById('password').value);
                    } else {
                        localStorage.removeItem('clothing_store_email');
                        localStorage.removeItem('clothing_store_password');
                    }
                });
            </script>

            <div class="mt-6 text-center text-sm">
                <p class="text-gray-500">
                    Belum punya akun? 
                    <a href="{{ route('register') }}" class="font-medium text-black hover:underline">Daftar disini</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection