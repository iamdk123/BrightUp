@extends('layouts.shop')

@section('title', 'Keranjang Belanja | BrightUp')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-2xl font-bold text-gray-900 mb-8">Keranjang Belanja</h1>

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
    @endif

    @if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('error') }}</span>
    </div>
    @endif

    @if($cartItems->isEmpty())
    <div class="text-center py-12">
        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 mb-4">
            <i class="fas fa-shopping-cart text-gray-400 text-2xl"></i>
        </div>
        <h2 class="text-xl font-semibold text-gray-900 mb-2">Keranjang Belanja Kosong</h2>
        <p class="text-gray-500 mb-6">Yuk, isi keranjang belanja Anda dengan produk-produk menarik!</p>
        <a href="{{ route('home') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
            <i class="fas fa-arrow-left mr-2"></i>
            Lanjutkan Belanja
        </a>
    </div>
    @else
    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Cart Items -->
        <div class="lg:w-2/3">
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="p-4 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-semibold text-gray-900">Daftar Produk</h2>
                        <span class="text-sm text-gray-500">{{ $cartItems->count() }} item</span>
                    </div>
                </div>
                <div class="divide-y divide-gray-200">
                    @foreach($cartItems as $item)
                    <div class="p-4">
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0">
                                @if(!empty($item->product->image))
                                    <img src="{{ asset('images/products/'.$item->product->image) }}" alt="{{ $item->product->name }}" class="h-24 w-24 object-cover rounded-lg" onerror="this.onerror=null; this.src='{{ asset('images/no-image.png') }}'; this.classList.add('bg-gray-100');">
                                @else
                                    <div class="bg-gray-200 h-24 w-24 flex items-center justify-center rounded-lg">
                                        <span class="text-gray-500">No Image</span>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="text-lg font-medium text-gray-900 mb-1">{{ $item->product->name }}</h3>
                                <p class="text-xl font-bold text-blue-600 mb-2">Rp {{ number_format($item->product->price, 0, ',', '.') }}</p>
                                
                                <div class="flex items-center space-x-4">
                                    <div class="flex items-center border rounded-lg">
                                        <form action="{{ route('cart.update', $item->id) }}" method="POST" class="flex items-center">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" name="action" value="decrease" class="px-3 py-1 text-gray-600 hover:text-gray-800 {{ $item->quantity <= 1 ? 'opacity-50 cursor-not-allowed' : '' }}" {{ $item->quantity <= 1 ? 'disabled' : '' }}>
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <span class="px-3 py-1 border-x text-center min-w-[2rem]">{{ $item->quantity }}</span>
                                            <button type="submit" name="action" value="increase" class="px-3 py-1 text-gray-600 hover:text-gray-800">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </form>
                                    </div>
                                    
                                    <form action="{{ route('cart.remove', $item->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="flex-shrink-0">
                                <p class="text-lg font-semibold text-gray-900">
                                    Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="lg:w-1/3">
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="p-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900">Ringkasan Pesanan</h2>
                </div>
                <div class="p-4 space-y-4">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Total Harga ({{ $cartItems->sum('quantity') }} item)</span>
                        <span class="text-gray-900 font-medium">
                            Rp {{ number_format($cartItems->sum(function($item) { return $item->product->price * $item->quantity; }), 0, ',', '.') }}
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Biaya Pengiriman</span>
                        <span class="text-gray-900 font-medium">Gratis</span>
                    </div>
                    <div class="border-t border-gray-200 pt-4">
                        <div class="flex justify-between">
                            <span class="text-lg font-semibold text-gray-900">Total Pembayaran</span>
                            <span class="text-xl font-bold text-blue-600">
                                Rp {{ number_format($cartItems->sum(function($item) { return $item->product->price * $item->quantity; }), 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                    <a href="{{ route('checkout') }}" class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center font-medium py-3 px-4 rounded-lg transition duration-300">
                        Lanjut ke Pembayaran
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection 