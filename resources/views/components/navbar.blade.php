<nav x-data="{ 
    isOpen: false,
    isScrolled: false,
    checkScroll() {
        this.isScrolled = window.pageYOffset > 20;
    }
}" 
@scroll.window="checkScroll"
:class="{ 'py-4': !isScrolled, 'py-2': isScrolled }"
class="fixed top-0 left-0 right-0 bg-white shadow-md transition-all duration-300 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="{{ route('home') }}" class="flex items-center">
                    <span :class="{ 'text-2xl': !isScrolled, 'text-xl': isScrolled }" 
                          class="font-bold text-navy-600 transition-all duration-300">
                        BrightUp
                    </span>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('home') }}" 
                   class="text-gray-600 hover:text-navy-600 px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('home') ? 'text-navy-600 border-b-2 border-navy-600' : '' }}">
                    Home
                </a>
                <a href="{{ route('cart') }}" 
                   class="text-gray-600 hover:text-navy-600 px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('cart') ? 'text-navy-600 border-b-2 border-navy-600' : '' }}">
                    Cart
                </a>
            </div>

            <!-- Right Icons -->
            <div class="flex items-center space-x-4">
                <!-- Cart Icon -->
                <a href="{{ route('cart') }}" class="relative text-gray-600 hover:text-navy-600">
                    <i class="fas fa-shopping-cart text-xl"></i>
                    @auth
                        @php
                            $cartCount = auth()->user()->cartItems()->sum('quantity') ?? 0;
                        @endphp
                        @if($cartCount > 0)
                            <span class="absolute -top-2 -right-2 bg-mustard-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                                {{ $cartCount }}
                            </span>
                        @endif
                    @endauth
                </a>

                <!-- Login/Logout Button -->
                @auth
                    <form method="POST" action="{{ route('logout') }}" class="flex items-center">
                        @csrf
                        <button type="submit" class="text-gray-600 hover:text-navy-600 p-2 flex items-center">
                            <i class="fas fa-sign-out-alt text-xl"></i>
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-navy-600 p-2">
                        <i class="fas fa-user text-xl"></i>
                    </a>
                @endauth

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button @click="isOpen = !isOpen" class="text-gray-600 hover:text-navy-600 focus:outline-none p-2">
                        <i x-show="!isOpen" class="fas fa-bars text-xl"></i>
                        <i x-show="isOpen" class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation -->
    <div x-show="isOpen" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="md:hidden">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
            <a href="{{ route('home') }}" 
               class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('home') ? 'text-navy-600 bg-navy-50' : 'text-gray-600 hover:text-navy-600 hover:bg-navy-50' }}">
                Home
            </a>
            <a href="{{ route('cart') }}" 
               class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('cart') ? 'text-navy-600 bg-navy-50' : 'text-gray-600 hover:text-navy-600 hover:bg-navy-50' }}">
                Cart
            </a>
        </div>
    </div>
</nav>

<!-- Add padding to body to account for fixed navbar -->
<div class="pt-16"></div> 