<!-- Products Section -->
<div x-data="{ 
    showModal: false,
    selectedProduct: null,
    openModal(product) {
        console.log('Opening modal with product:', product);
        this.selectedProduct = product;
        this.showModal = true;
        document.body.style.overflow = 'hidden';
    },
    closeModal() {
        this.showModal = false;
        this.selectedProduct = null;
        document.body.style.overflow = 'auto';
    }
}">
    <div class="bg-white py-16" id="featured-products">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                    Featured Products
                </h2>
                <p class="mt-4 text-lg text-gray-500">
                    Discover our handpicked selection of premium products
                </p>
            </div>

            <div class="mt-12 grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($products as $product)
                <div class="group bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-lg transition duration-300 transform hover:-translate-y-1">
                    <div class="relative">
                        <img src="{{ file_exists(public_path('images/products/' . $product->image)) ? asset('images/products/' . $product->image) : asset('images/products/default.jpg') }}" 
                             alt="{{ $product->name }}" 
                             class="w-full h-64 object-cover">
                        <button onclick="toggleWishlist({{ $product->id }})" 
                                class="absolute top-2 right-2 p-2 bg-white rounded-full shadow-lg hover:bg-gray-100 transition duration-300">
                            <i id="wishlist-{{ $product->id }}" class="fas fa-heart text-gray-300 text-xl"></i>
                        </button>
                        <button type="button"
                                @click="openModal({
                                    id: {{ $product->id }},
                                    name: '{{ addslashes($product->name) }}',
                                    image: '{{ asset('images/products/' . $product->image) }}',
                                    price: {{ $product->price }},
                                    description: '{{ addslashes($product->description) }}'
                                })"
                                class="absolute bottom-0 left-0 right-0 bg-blue-600/80 text-white py-2 text-center opacity-0 group-hover:opacity-100 transition duration-300">
                            Quick View
                        </button>
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-medium text-gray-900">{{ $product->name }}</h3>
                        <p class="mt-1 text-lg font-semibold text-blue-600">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        <div class="mt-4">
                            <!-- <a href="{{ route('product.detail', ['id' => $product->id]) }}" 
                               class="w-full flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                View Details
                            </a> -->
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Quick View Modal -->
    <div x-show="showModal"
        x-cloak
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-50 overflow-y-auto" 
        @click.self="closeModal"
        @keydown.escape.window="closeModal">
        
        <!-- Modal Backdrop -->
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

        <!-- Modal Content -->
        <div class="relative transform transition-all sm:my-8 sm:max-w-lg sm:w-full sm:mx-auto"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
            
            <div class="bg-white rounded-lg shadow-xl overflow-hidden">
                <!-- Close Button -->
                <button @click="closeModal" class="absolute top-2 right-2 p-2 text-gray-400 hover:text-gray-500">
                    <i class="fas fa-times text-xl"></i>
                </button>

                <!-- Product Content -->
                <template x-if="selectedProduct">
                    <div class="p-6">
                        <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-lg">
                            <img :src="selectedProduct.image" :alt="selectedProduct.name" class="w-full h-64 object-cover">
                        </div>
                        <div class="mt-4">
                            <h3 class="text-2xl font-semibold text-gray-900" x-text="selectedProduct.name"></h3>
                            <p class="mt-2 text-xl font-semibold text-blue-600" x-text="'Rp ' + new Intl.NumberFormat('id-ID').format(selectedProduct.price)"></p>
                            <p class="mt-4 text-gray-500" x-text="selectedProduct.description"></p>
                        </div>
                        <div class="mt-6 space-y-3">
                            <!-- Add to Cart Form -->
                            <form method="POST" :action="'{{ url('/cart/add') }}'">
                                @csrf
                                <input type="hidden" name="product_id" :value="selectedProduct.id">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" 
                                        class="w-full flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    <i class="fas fa-shopping-cart mr-2"></i>
                                    Add to Cart
                                </button>
                            </form>

                            <!-- View Details Button -->
                            <a :href="'{{ url('/product') }}/' + selectedProduct.id"
                               class="w-full flex items-center justify-center px-6 py-3 border border-blue-600 text-base font-medium rounded-md text-blue-600 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <i class="fas fa-eye mr-2"></i>
                                View Details
                            </a>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>
</div>

<style>
    [x-cloak] { display: none !important; }
</style> 