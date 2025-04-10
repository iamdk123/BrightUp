<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes (Tidak perlu login)
|--------------------------------------------------------------------------
*/

// Homepage - Daftar Produk (Bisa diakses tanpa login)
Route::get('/', [ProductController::class, 'index'])->name('home');

// Detail Produk (Bisa diakses tanpa login)
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.detail');

/*
|--------------------------------------------------------------------------
| Protected Routes (Perlu login)
|--------------------------------------------------------------------------
*/

// Route yang memerlukan login
Route::middleware('auth')->group(function () {
    // Add to Cart Action
    Route::post('/add-to-cart', function () {
        $productId = request('product_id');
        
        // Get product details from our dummy data
        $products = [
            1 => [
                'id' => 1,
                'name' => 'Kaos Polos Hitam',
                'price' => 75000,
                'image' => './public/images/products/kaos-hitam.jpg',
                'description' => 'Kaos polos warna hitam, bahan cotton combed 30s, nyaman dipakai sehari-hari.'
            ],
            2 => [
                'id' => 2,
                'name' => 'Celana Jeans Biru',
                'price' => 150000,
                'image' => 'https://via.placeholder.com/400x400',
                'description' => 'Celana jeans biru dengan bahan denim premium, potongan slim fit yang nyaman dipakai harian maupun acara kasual.'
            ],
            3 => [
                'id' => 3,
                'name' => 'Jaket Hoodie Abu',
                'price' => 200000,
                'image' => 'https://via.placeholder.com/400x400',
                'description' => 'Jaket hoodie dengan bahan fleece tebal yang nyaman dan hangat. Cocok untuk aktivitas outdoor atau casual.'
            ],
            4 => [
                'id' => 4,
                'name' => 'Kemeja Flanel Kotak',
                'price' => 120000,
                'image' => 'https://via.placeholder.com/400x400',
                'description' => 'Kemeja flanel motif kotak dengan bahan premium yang nyaman, cocok untuk gaya kasual sehari-hari.'
            ],
            5 => [
                'id' => 5,
                'name' => 'Topi Baseball Hitam',
                'price' => 60000,
                'image' => 'https://via.placeholder.com/400x400',
                'description' => 'Topi baseball polos warna hitam, dengan bahan cotton yang nyaman dan adjustable size.'
            ],
            6 => [
                'id' => 6,
                'name' => 'Sepatu Sneakers Putih',
                'price' => 350000,
                'image' => 'https://via.placeholder.com/400x400',
                'description' => 'Sepatu sneakers casual warna putih, desain minimalis dengan bahan premium yang nyaman dipakai sepanjang hari.'
            ],
        ];

        if (!isset($products[$productId])) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan!');
        }

        $product = $products[$productId];
        
        // Initialize cart if not exists
        if (!session()->has('cart')) {
            session()->put('cart', []);
        }

        // Add product to cart
        $cart = session()->get('cart');
        $cart[] = [
            'id' => $product['id'],
            'name' => $product['name'],
            'price' => $product['price'],
            'image' => $product['image'],
            'quantity' => 1
        ];
        session()->put('cart', $cart);

        return redirect()->route('cart')->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    })->name('cart.add');

    // Cart routes
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::put('/cart/{id}/update', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{id}/remove', [CartController::class, 'remove'])->name('cart.remove');
    Route::delete('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

    // Checkout routes
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
});

/*
|--------------------------------------------------------------------------
| User Profile Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Category routes
Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('category');

require __DIR__.'/auth.php';
