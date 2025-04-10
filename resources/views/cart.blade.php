@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">Shopping Cart</h1>

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

    @if(empty(session('cart')))
        <div class="text-center py-8">
            <p class="text-gray-600 text-lg">Your cart is empty</p>
            <a href="{{ route('home') }}" class="mt-4 inline-block bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-md transition-colors">
                Continue Shopping
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-4">
                        <h2 class="text-xl font-semibold mb-4">Cart Items</h2>
                        @foreach(session('cart') as $id => $item)
                            <div class="flex items-center border-b border-gray-200 py-4">
                                <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="w-24 h-24 object-cover rounded">
                                <div class="ml-4 flex-grow">
                                    <h3 class="text-lg font-semibold">{{ $item['name'] }}</h3>
                                    <p class="text-gray-600">Rp {{ number_format($item['price'], 0, ',', '.') }}</p>
                                    <div class="flex items-center mt-2">
                                        <form action="{{ route('cart.update') }}" method="POST" class="flex items-center">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $id }}">
                                            <button type="button" class="decrease-quantity bg-gray-200 px-2 py-1 rounded">-</button>
                                            <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="w-12 text-center mx-2">
                                            <button type="button" class="increase-quantity bg-gray-200 px-2 py-1 rounded">+</button>
                                            <button type="submit" class="ml-4 text-blue-500 hover:text-blue-600">Update</button>
                                        </form>
                                        <form action="{{ route('cart.remove') }}" method="POST" class="ml-4">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $id }}">
                                            <button type="submit" class="text-red-500 hover:text-red-600">Remove</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-md p-4">
                    <h2 class="text-xl font-semibold mb-4">Order Summary</h2>
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span>Subtotal</span>
                            <span>Rp {{ number_format(array_sum(array_map(function($item) { return $item['price'] * $item['quantity']; }, session('cart'))), 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Shipping</span>
                            <span>Free</span>
                        </div>
                        <div class="border-t border-gray-200 my-2"></div>
                        <div class="flex justify-between font-bold">
                            <span>Total</span>
                            <span>Rp {{ number_format(array_sum(array_map(function($item) { return $item['price'] * $item['quantity']; }, session('cart'))), 0, ',', '.') }}</span>
                        </div>
                    </div>
                    <button class="w-full bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md mt-4 transition-colors">
                        Proceed to Checkout
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const decreaseButtons = document.querySelectorAll('.decrease-quantity');
        const increaseButtons = document.querySelectorAll('.increase-quantity');
        const quantityInputs = document.querySelectorAll('input[name="quantity"]');

        decreaseButtons.forEach((button, index) => {
            button.addEventListener('click', () => {
                const input = quantityInputs[index];
                if (parseInt(input.value) > 1) {
                    input.value = parseInt(input.value) - 1;
                }
            });
        });

        increaseButtons.forEach((button, index) => {
            button.addEventListener('click', () => {
                const input = quantityInputs[index];
                input.value = parseInt(input.value) + 1;
            });
        });
    });
</script>
@endpush
@endsection 