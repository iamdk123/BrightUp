<!-- Categories Section -->
<div class="bg-gray-50 py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h2 class="text-3xl font-extrabold text-navy-900 sm:text-4xl">
                Shop by Category
            </h2>
            <p class="mt-4 text-lg text-gray-500">
                Browse our wide range of product categories
            </p>
        </div>

        <div class="mt-16 grid grid-cols-2 gap-6 sm:grid-cols-3 lg:grid-cols-6">
            @foreach($categories as $category)
            <a href="{{ route('category', ['slug' => $category['slug']]) }}" 
               class="bg-white rounded-xl shadow-sm p-8 text-center hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="flex items-center justify-center h-12 w-12 rounded-xl bg-navy-900 text-mustard-400 mx-auto shadow-lg">
                    <i class="fas fa-{{ $category['icon'] }} text-xl"></i>
                </div>
                <h3 class="mt-6 text-sm font-semibold text-navy-900">{{ $category['name'] }}</h3>
            </a>
            @endforeach
        </div>
    </div>
</div> 