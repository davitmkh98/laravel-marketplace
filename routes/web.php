<?php


use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\WishlistController;



Route::get('/', [ProductController::class, 'index'])
    ->name('home');


Route::middleware('auth')->group(function () {

    Route::get('/products', [ProductController::class, 'index'])
    ->name('products.index');

   Route::get('/products/create', [ProductController::class, 'create'])
    ->middleware('auth')
    ->name('products.create');

Route::post('/products', [ProductController::class, 'store'])
    ->middleware('auth')
    ->name('products.store');

});


Route::get('/products/{product}/edit', [ProductController::class, 'edit'])
    ->middleware('auth')->name('products.edit');


Route::put('/products/{product}', [ProductController::class, 'update'])
    ->middleware('auth')
    ->name('products.update');

Route::delete('/products/{product}', [ProductController::class, 'destroy'])
    ->middleware('auth')
    ->name('products.destroy');

Route::get('/products/{product}', [ProductController::class, 'show'])
    ->name('products.show');



Route::get('/users/{user}', [UserController::class, 'show'])
    ->name('users.show');





Route::get('/cart', [CartController::class, 'index'])
    ->name('cart.index');

Route::post('/cart/{product}', [CartController::class, 'store'])
    ->name('cart.store');

Route::delete('/cart/{id}', [CartController::class, 'destroy'])
    ->name('cart.destroy');




Route::post('/checkout', [OrderController::class, 'store'])
    ->name('checkout.store');


Route::post('/products/{product}/reviews', [ReviewController::class, 'store'])
    ->middleware('auth')
    ->name('reviews.store');



Route::get('/orders', [OrderController::class, 'index'])
    ->middleware('auth')
    ->name('orders.index');

Route::get('/orders/{order}', [OrderController::class, 'show'])
    ->middleware('auth')
    ->name('orders.show');

Route::get('/seller/products', [ProductController::class, 'sellerProducts'])
    ->middleware('auth')
    ->name('seller.products');




Route::get('/seller/products/{product}/edit', [ProductController::class, 'edit'])
    ->middleware('auth')
    ->name('seller.products.edit');





Route::post('/wishlist/{product}', [WishlistController::class, 'store'])
    ->middleware('auth')
    ->name('wishlist.store');


Route::delete('/wishlist/{product}', [WishlistController::class, 'destroy'])
    ->middleware('auth')
    ->name('wishlist.destroy');


    

Route::get('/wishlist', [WishlistController::class, 'index'])
    ->middleware('auth')
    ->name('wishlist.index');







Route::get('/seller/orders', [OrderController::class, 'sellerOrders'])
    ->middleware('auth')
    ->name('seller.orders');


Route::get('/seller/orders/{order}', [OrderController::class, 'sellerShow'])
    ->middleware('auth')
    ->name('seller.orders.show');


Route::put('/seller/orders/{order}', [OrderController::class, 'update'])
    ->middleware('auth')
    ->name('seller.orders.update');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';