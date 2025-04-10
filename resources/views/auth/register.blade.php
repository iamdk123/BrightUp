@extends('layouts.guest')

@section('content')
<div class="min-h-screen flex flex-col md:flex-row">
    <!-- Left Side - Image Section -->
    <div class="flex md:w-1/2 relative h-48 md:h-auto">
        <img src="{{ asset('images/auth/register-visual.jpg') }}" alt="Brand Visual" class="object-cover w-full h-full">
        <div class="absolute inset-0 bg-navy-900/70 flex flex-col justify-between p-6 md:p-12">
            <div>
            </div>
            <div class="text-white/90 max-w-md hidden md:block">
                <p class="text-lg md:text-2xl font-light italic">"Bergabunglah dengan kami dan temukan pengalaman berbelanja yang lebih personal dan memuaskan."</p>
            </div>
        </div>
    </div>

    <!-- Right Side - Registration Form -->
    <div class="w-full md:w-1/2 flex items-center justify-center px-6 py-8 md:py-12 md:px-16 lg:px-24">
        <div class="w-full max-w-md">
            <div class="text-center mb-8 md:mb-10">
                <h1 class="text-2xl md:text-3xl font-bold text-navy-800 mb-2">Buat Akun Baru</h1>
                <p class="text-gray-600">Lengkapi informasi di bawah untuk mendaftar</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-navy-600 focus:border-navy-600 transition-colors
                        @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-navy-600 focus:border-navy-600 transition-colors
                        @error('email') border-red-500 @enderror">
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input id="password" type="password" name="password" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-navy-600 focus:border-navy-600 transition-colors
                        @error('password') border-red-500 @enderror">
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-navy-600 focus:border-navy-600 transition-colors">
                </div>

                <!-- Terms and Conditions -->
                <div class="flex items-start mt-4">
                    <div class="flex items-center h-5">
                        <input id="terms" name="terms" type="checkbox" required class="h-4 w-4 text-navy-600 border-gray-300 rounded focus:ring-navy-600">
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="terms" class="text-gray-700">
                            Saya menyetujui <a href="#" class="text-mustard-600 hover:text-mustard-700">Syarat & Ketentuan</a> serta <a href="#" class="text-mustard-600 hover:text-mustard-700">Kebijakan Privasi</a>
                        </label>
                    </div>
                </div>

                <button type="submit" class="w-full bg-navy-700 hover:bg-navy-800 text-white py-3 rounded-lg font-medium transition-colors duration-300 mt-6 flex items-center justify-center shadow-md hover:shadow-lg">
                    <span>Daftar Sekarang</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </form>

            <div class="text-center mt-8">
                <p class="text-gray-600">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="text-mustard-600 hover:text-mustard-700 font-medium">
                        Masuk
                    </a>
                </p>
            </div>

            <div class="relative my-8">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-2 bg-white text-gray-500">atau daftar dengan</span>
                </div>
            </div>

            <div class="flex space-x-4">
                <a href="#" class="flex-1 flex items-center justify-center px-4 py-3 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">
                    <i class="fab fa-google mr-2 text-red-500"></i>
                    Google
                </a>
                <a href="#" class="flex-1 flex items-center justify-center px-4 py-3 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">
                    <i class="fab fa-facebook-f mr-2 text-blue-600"></i>
                    Facebook
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
