@extends('layouts.shop')

@section('title', 'Checkout | BrightUp')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-2xl font-bold text-gray-900 mb-8">Checkout</h1>

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

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Order Summary -->
        <div class="lg:col-span-2">
            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6">
                    <h2 class="text-lg leading-6 font-medium text-gray-900">Order Summary</h2>
                </div>
                <div class="border-t border-gray-200">
                    <ul>
                        @foreach($cartItems as $item)
                        <li class="border-b border-gray-200">
                            <div class="px-4 py-4 sm:px-6">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        @if(!empty($item->product->image))
                                            <img src="{{ asset('images/products/'.$item->product->image) }}" alt="{{ $item->product->name }}" class="h-16 w-16 object-cover rounded" onerror="this.onerror=null; this.src='{{ asset('images/no-image.png') }}'; this.classList.add('bg-gray-100');">
                                        @else
                                            <div class="bg-gray-200 h-16 w-16 flex items-center justify-center rounded">
                                                <span class="text-gray-500 text-xs">No Image</span>
                                            </div>
                                        @endif
                                        <div class="ml-4">
                                            <h3 class="text-lg font-medium text-gray-900">{{ $item->product->name }}</h3>
                                            <p class="text-gray-500">Rp {{ number_format($item->product->price, 0, ',', '.') }} x {{ $item->quantity }}</p>
                                        </div>
                                    </div>
                                    <div class="text-lg font-medium text-gray-900">
                                        Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="px-4 py-5 sm:px-6">
                    <div class="flex justify-between items-center">
                        <div class="text-lg font-medium text-gray-900">Total</div>
                        <div class="text-xl font-bold text-gray-900">
                            Rp {{ number_format($cartItems->sum(function($item) { return $item->product->price * $item->quantity; }), 0, ',', '.') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Form -->
        <div class="lg:col-span-1">
            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6">
                    <h2 class="text-lg leading-6 font-medium text-gray-900">Metode Pembayaran</h2>
                </div>
                <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                    <form action="{{ route('checkout.process') }}" method="POST">
                        @csrf
                        <div class="space-y-6">
                            <!-- Transfer Bank -->
                            <div class="border rounded-lg p-4">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Transfer Bank</h3>
                                <div class="space-y-4">
                                    <div class="flex items-center space-x-3">
                                        <input type="radio" name="payment_method" value="bca" id="bca" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                        <label for="bca" class="flex items-center">
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/5/5c/Bank_Central_Asia.svg" alt="BCA" class="h-6 w-6 mr-2">
                                            <span>BCA</span>
                                        </label>
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        <input type="radio" name="payment_method" value="mandiri" id="mandiri" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                        <label for="mandiri" class="flex items-center">
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/a/ad/Bank_Mandiri_logo_2016.svg" alt="Mandiri" class="h-6 w-6 mr-2">
                                            <span>Mandiri</span>
                                        </label>
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        <input type="radio" name="payment_method" value="bni" id="bni" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                        <label for="bni" class="flex items-center">
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/c/c3/BNI_logo.svg" alt="BNI" class="h-6 w-6 mr-2">
                                            <span>BNI</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- E-Wallet -->
                            <div class="border rounded-lg p-4">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">E-Wallet</h3>
                                <div class="space-y-4">
                                    <div class="flex items-center space-x-3">
                                        <input type="radio" name="payment_method" value="gopay" id="gopay" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                        <label for="gopay" class="flex items-center">
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/8/86/GoPay_logo.svg" alt="GoPay" class="h-6 w-6 mr-2">
                                            <span>GoPay</span>
                                        </label>
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        <input type="radio" name="payment_method" value="ovo" id="ovo" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                        <label for="ovo" class="flex items-center">
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/7/72/OVO_logo.svg" alt="OVO" class="h-6 w-6 mr-2">
                                            <span>OVO</span>
                                        </label>
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        <input type="radio" name="payment_method" value="dana" id="dana" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                        <label for="dana" class="flex items-center">
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/7/72/DANA_logo.svg" alt="DANA" class="h-6 w-6 mr-2">
                                            <span>DANA</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- COD -->
                            <div class="border rounded-lg p-4">
                                <div class="flex items-center space-x-3">
                                    <input type="radio" name="payment_method" value="cod" id="cod" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                    <label for="cod" class="flex items-center">
                                        <img src="https://upload.wikimedia.org/wikipedia/commons/3/3e/Shopee_logo.svg" alt="COD" class="h-6 w-6 mr-2">
                                        <span>Bayar di Tempat (COD)</span>
                                    </label>
                                </div>
                            </div>

                            <button type="submit" class="w-full bg-blue-600 text-white px-4 py-3 rounded-lg hover:bg-blue-700 transition duration-300 font-medium">
                                Bayar Sekarang
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 