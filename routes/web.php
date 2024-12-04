<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthenticateAdmin;
use App\Http\Middleware\MustNotBeAdmin;
use App\Http\Middleware\AuthenticateUser;
use Illuminate\Support\Facades\Route;

// Public Routes (No Authentication Required)
Route::middleware([MustNotBeAdmin::class])->group(function () {
    Route::get('/', [ProdukController::class, 'index'])->name('home');
    Route::get('/shop', [ProdukController::class, 'shop'])->name('shop');
    Route::get('/shop/{id}', [ProdukController::class, 'show'])->name('produk.show');
    Route::get('/about', function () {return view('about');})->name('about');
    Route::get('/contact', function () {return view('contact');})->name('contact');
});

// Routes that require authentication
Route::middleware([MustNotBeAdmin::class, AuthenticateUser::class])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::patch('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/destroy/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
    
    // Checkout Success and Orders
    Route::post('/checkout/success', [OrderController::class, 'placeOrder'])->name('checkout.placeOrder');
    Route::get('/orders', [OrderController::class, 'viewOrders'])->name('orders.view');

    Route::get('/payment/{order}', [OrderController::class, 'showPayment'])->name('payment.show');
    Route::post('/payment/{order}', [OrderController::class, 'submitPaymentProof'])->name('payment.submit');
});

// Admin Routes (For Admin Users Only)
Route::prefix('admin')->name('admin.')->middleware([AuthenticateAdmin::class])->group(function () {
    Route::get('/', [AdminController::class, 'adminhome'])->name('index');
    Route::get('/products', action: [AdminController::class, 'viewProducts'])->name('products');
    Route::get('/admins', [AdminController::class, 'viewAdmins'])->name('admins');
    Route::get('/orders', [AdminController::class, 'viewOrders'])->name('orders');
    
    // /users -> Index
    // /users/create -> Create
    // /users/{id} -> Show
    // /users/{id}/edit -> Edit
    // /users/{id}/update -> Update
    // /users/{id}/destroy -> Destroy
    Route::resource('users', UserController::class)->names('users')->except(['show']);
    Route::resource('admins', AdminController::class)->names('admins')->except(['show']);

    // Actions for editing products, users, orders
    Route::get('/product/add', [AdminController::class, 'addProduct'])->name('product.add');
    Route::post('/product/add', [AdminController::class, 'storeProduct'])->name('product.store');
    Route::get('/product/{id}/edit', [AdminController::class, 'editProduct'])->name('product.edit');
    Route::post('/product/{id}/update', [AdminController::class, 'updateProduct'])->name('product.update');
    Route::delete('/product/{id}/delete', [AdminController::class, 'deleteProduct'])->name('product.delete');
    // Route::get('/admin/order/{id}/status', [AdminController::class, 'updateOrderStatus'])->name('admin.order.status');
    Route::post('/order/{id}/status', [AdminController::class, 'updateOrderStatus'])->name('order.status');
});

require __DIR__.'/auth.php';
