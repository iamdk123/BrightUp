@extends('layouts.shop')

@section('title', $product->name . ' | BrightUp')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Breadcrumb -->
    <nav class="flex mb-8" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-600">
                    <i class="fas fa-home mr-2"></i>
                    Home
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                    <span class="text-gray-500">{{ $product->name }}</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Product Detail Section -->
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 p-6">
            <!-- Product Image -->
            <div class="relative">
                <img src="{{ file_exists(public_path('images/products/' . $product->image)) ? asset('images/products/' . $product->image) : asset('images/products/default.jpg') }}" 
                     alt="{{ $product->name }}" 
                     class="w-full h-96 object-cover rounded-lg">
                <!-- Wishlist Button -->
                <button onclick="toggleWishlist({{ $product->id }})" class="absolute top-4 right-4 p-3 bg-white rounded-full shadow-lg hover:bg-gray-100 transition duration-300">
                    <i id="wishlist-{{ $product->id }}" class="fas fa-heart text-gray-300 text-xl"></i>
                </button>
                <!-- Wishlist Badge -->
                <div id="wishlist-badge-{{ $product->id }}" class="absolute top-4 left-4 bg-red-500 text-white text-sm px-3 py-1 rounded-full hidden">
                    <i class="fas fa-heart mr-1"></i> Favorit
                </div>
            </div>

            <!-- Product Info -->
            <div class="space-y-6">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $product->name }}</h1>
                    <p class="text-2xl font-bold text-blue-600">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                </div>

                <div class="border-t border-b border-gray-200 py-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Deskripsi Produk</h2>
                    <p class="text-gray-600 leading-relaxed">{{ $product->description }}</p>
                </div>

                <div class="flex space-x-4">
                    @auth
                        <form action="{{ route('cart.add') }}" method="POST" class="flex-1">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded-lg transition duration-300 flex items-center justify-center">
                                <i class="fas fa-shopping-cart mr-2"></i>
                                Tambah ke Keranjang
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="flex-1 block bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded-lg transition duration-300 text-center">
                            Login untuk Beli
                        </a>
                    @endauth
                </div>

                <!-- Back to Home Button -->
                <div class="pt-6">
                    <a href="{{ route('home') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali ke Homepage
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Products Section -->
    <div class="mt-12">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Produk Terkait</h2>
        @if($relatedProducts->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($relatedProducts as $relatedProduct)
                <div class="bg-white rounded-lg shadow-sm hover:shadow-lg transition duration-300 transform hover:-translate-y-1">
                    <a href="{{ route('product.detail', ['id' => $relatedProduct->id]) }}" class="block">
                        <img src="{{ file_exists(public_path('images/products/' . $relatedProduct->image)) ? asset('images/products/' . $relatedProduct->image) : asset('images/products/default.jpg') }}" 
                             alt="{{ $relatedProduct->name }}" 
                             class="w-full h-48 object-cover rounded-t-lg">
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $relatedProduct->name }}</h3>
                            <p class="text-xl font-bold text-blue-600">Rp {{ number_format($relatedProduct->price, 0, ',', '.') }}</p>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-8">
                <p class="text-gray-500">Belum ada produk terkait dalam kategori ini.</p>
            </div>
        @endif
    </div>
</div>

@if(!$product)
    <!-- 404 Error Page -->
    <div class="min-h-screen flex items-center justify-center bg-gray-50">
        <div class="text-center">
            <h1 class="text-6xl font-bold text-gray-900 mb-4">404</h1>
            <p class="text-xl text-gray-600 mb-8">Produk tidak ditemukan</p>
            <a href="{{ route('home') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali ke Homepage
            </a>
        </div>
    </div>
@endif
@endsection 