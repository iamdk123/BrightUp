<!-- Hero Section -->
<div class="relative h-[600px] overflow-hidden">
    <!-- Background Image with Overlay -->
    <div class="absolute inset-0">
        <img src="{{ asset('images/products/hero-bg.jpg') }}" alt="Lifestyle" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-navy-900/70 backdrop-blur-sm"></div>
    </div>

    <!-- Content -->
    <div class="relative max-w-7xl mx-auto h-full px-8 sm:px-12 lg:px-16">
        <div class="flex flex-col justify-center h-full max-w-2xl pt-16">
            <h1 class="text-4xl tracking-tight font-extrabold text-white sm:text-5xl md:text-6xl [text-shadow:_0_2px_4px_rgba(0,0,0,0.3)]">
                <span class="block">Elevate Your Style</span>
                <span class="block text-mustard-400 [text-shadow:_0_2px_4px_rgba(0,0,0,0.3)]">With Premium Quality</span>
            </h1>
            <p class="mt-4 text-base text-white/90 sm:mt-5 sm:text-lg sm:max-w-xl md:mt-5 md:text-xl">
                Experience shopping like never before. We bring you the best products with exceptional quality and service.
            </p>
            <div class="mt-10">
                <a href="#featured-products" 
                   class="inline-flex items-center px-8 py-4 border border-transparent text-lg font-bold rounded-lg text-navy-900 bg-mustard-400 hover:bg-mustard-300 transition-all duration-300 transform hover:scale-105 hover:shadow-lg">
                    Shop Now
                    <svg class="ml-2 -mr-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div> 