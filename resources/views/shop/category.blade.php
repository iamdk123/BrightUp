@extends('layouts.shop')

@section('title', $category->name . ' - Online Shop')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Breadcrumb -->
    <nav class="flex mb-8" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-600">
                    <i class="fas fa-home mr-2"></i>
                    Home
                </a>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                    <span class="text-gray-500">{{ $category->name }}</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Category Header -->
    <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
        <div class="flex items-center">
            <i class="fas fa-{{ $category->icon }} text-4xl text-blue-600 mr-4"></i>
            <div>
                <h1 class="text-2xl font-bold text-gray-900">{{ $category->name }}</h1>
                <p class="text-gray-600 mt-1">Browse our collection of {{ strtolower($category->name) }} products</p>
            </div>
        </div>
    </div>

    <!-- Products Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse($products as $product)
        <div class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition duration-300">
            <a href="{{ route('product.detail', ['id' => $product->id]) }}" class="block">
                <img src="{{ file_exists(public_path('images/products/' . $product->image)) ? asset('images/products/' . $product->image) : asset('images/products/default.jpg') }}" 
                     alt="{{ $product->name }}" 
                     class="w-full h-48 object-cover">
            </a>
            <div class="p-4">
                <a href="{{ route('product.detail', ['id' => $product->id]) }}" class="block">
                    <h3 class="text-lg font-medium text-gray-900 hover:text-blue-600">{{ $product->name }}</h3>
                </a>
                <p class="mt-1 text-lg font-semibold text-blue-600">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                <div class="mt-4 flex justify-between items-center">
                    <a href="{{ route('product.detail', ['id' => $product->id]) }}" class="text-blue-600 hover:text-blue-800">
                        <i class="fas fa-eye mr-1"></i> Lihat Detail
                    </a>
                    @auth
                    <form action="{{ route('cart.add') }}" method="POST" class="inline">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition duration-300">
                            <i class="fas fa-shopping-cart mr-1"></i> Add to Cart
                        </button>
                    </form>
                    @else
                    <a href="{{ route('login') }}" class="bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700 transition duration-300">
                        <i class="fas fa-lock mr-1"></i> Login untuk Beli
                    </a>
                    @endauth
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-12">
            <i class="fas fa-box-open text-4xl text-gray-400 mb-4"></i>
            <h3 class="text-lg font-medium text-gray-900">No products found</h3>
            <p class="mt-1 text-gray-500">There are no products available in this category at the moment.</p>
            <a href="{{ route('home') }}" class="mt-4 inline-flex items-center text-blue-600 hover:text-blue-800">
                <i class="fas fa-arrow-left mr-2"></i> Back to Homepage
            </a>
        </div>
        @endforelse
    </div>
</div>
@endsection 