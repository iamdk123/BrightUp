<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'BrightUp - Temukan Produk Terbaikmu!')</title>
    
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon.png') }}">
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        // Konfigurasi Tailwind untuk warna dan animasi
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        navy: {
                            50: '#f5f7fa',
                            100: '#eaeef4',
                            200: '#d5dfe9',
                            300: '#b3c5d9',
                            400: '#8aa3c4',
                            500: '#6784b0',
                            600: '#4c6a96',
                            700: '#3d567a',
                            800: '#334663',
                            900: '#1a2437',
                        },
                        mustard: {
                            50: '#fefbe8',
                            100: '#fff7c2',
                            200: '#ffea89',
                            300: '#ffd649',
                            400: '#ffc71f',
                            500: '#faa307',
                            600: '#dc7902',
                            700: '#b75506',
                            800: '#94410c',
                            900: '#7a360d',
                        }
                    },
                    keyframes: {
                        'fade-in': {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' }
                        },
                        'scale-up': {
                            '0%': { transform: 'scale(0.95)' },
                            '100%': { transform: 'scale(1)' }
                        }
                    },
                    animation: {
                        'fade-in': 'fade-in 0.3s ease-out',
                        'scale-up': 'scale-up 0.2s ease-out'
                    }
                }
            }
        }
    </script>
    
    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-50">
    <!-- Navbar Component -->
    @include('components.navbar')

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t mt-12">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <p class="text-center text-gray-500 text-sm">
                &copy; 2024 Online Shop. All rights reserved.
            </p>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        // Wishlist functionality
        function toggleWishlist(productId) {
            const heartIcon = document.getElementById(`wishlist-${productId}`);
            const productCard = document.getElementById(`product-${productId}`);
            const wishlistBadge = document.getElementById(`wishlist-badge-${productId}`);
            
            heartIcon.classList.toggle('text-red-500');
            heartIcon.classList.toggle('text-gray-300');
            wishlistBadge.classList.toggle('hidden');
            
            const wishlist = JSON.parse(sessionStorage.getItem('wishlist') || '[]');
            const index = wishlist.indexOf(productId);
            
            if (index === -1) {
                wishlist.push(productId);
            } else {
                wishlist.splice(index, 1);
            }
            
            sessionStorage.setItem('wishlist', JSON.stringify(wishlist));
        }

        // Simulate loading
        document.addEventListener('DOMContentLoaded', function() {
            const skeleton = document.getElementById('productSkeleton');
            const productGrid = document.getElementById('productGrid');
            
            if (skeleton && productGrid) {
                setTimeout(() => {
                    skeleton.classList.add('hidden');
                    productGrid.classList.remove('hidden');
                }, 2000);
            }
        });
    </script>
</body>
</html> 