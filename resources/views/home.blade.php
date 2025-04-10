<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($products as $product)
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" class="w-full h-64 object-cover">
            <div class="p-4">
                <h3 class="text-lg font-semibold mb-2">{{ $product['name'] }}</h3>
                <p class="text-gray-600 mb-4">{{ $product['description'] }}</p>
                <div class="flex justify-between items-center">
                    <span class="text-xl font-bold">Rp {{ number_format($product['price'], 0, ',', '.') }}</span>
                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product['id'] }}">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md transition-colors">
                            Add to Cart
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</div> 