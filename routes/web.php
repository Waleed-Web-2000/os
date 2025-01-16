<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\AuthAdmin;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController; 
use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PayoutRequestController;
use App\Http\Controllers\CartController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',AuthAdmin::class,
    config('jetstream.auth_session'),
    'verified'
])->group(function () { 
    Route::controller(HomeController::class)->group(function () {
    Route::get('settings', 'setting')->name('settings');
    Route::get('dashboard', 'dashboard')->name('dashboard');
    Route::get('users-all', 'user_index')->name('user.all');
    Route::get('userall/{id}/status', 'status')->name('user.status');
    Route::put('settings/update/{id}', 'update')->name('settings.update');
    Route::get('add-to-cart-orders', 'AddtoCartOrders')->name('addtocartorders');
    Route::get('add-to-cart-single-orders/{order_id}', 'SingleAddtoCartOrders')->name('singleaddtocartorders');
    Route::delete('add-to-cart-single-orders/{order_id}', 'AddtoCartOrdersDelete')->name('singleaddtocartordersdelete');
    Route::put('order-status', 'UpdateOrderStatus')->name('order.status.update'); 
    Route::get('/admin/user/payout', 'UserPayout')->name('admin.user.payout');
    Route::put('/admin/user/{id}/status', 'PayoutUpdateStatus')->name('admin.user.payout.status');
	});

	Route::controller(ProductController::class)->group(function () {
    Route::get('product', 'index')->name('product.all');
    Route::get('product/create', 'create')->name('product.create');
    Route::post('product/store', 'store')->name('product.store');
    Route::get('product/{id}/edit', 'edit')->name('product.edit');
    Route::put('product/update/{id}', 'update')->name('product.update');
    Route::get('product/delete/{id}', 'destroy')->name('product.destroy');
    Route::get('product/{id}/status', 'status')->name('product.status');
    Route::get('product/export-products', 'export')->name('products.export');
    Route::post('product/import-products', 'import')->name('products.import');
});


	Route::controller(CategoryController::class)->group(function () {
    Route::get('category', 'index')->name('category.all');
    Route::get('category/create', 'create')->name('category.create');
    Route::post('category/store', 'store')->name('category.store');
    Route::get('category/{id}/edit', 'edit')->name('category.edit');
    Route::put('category/update/{id}', 'update')->name('category.update');
    Route::get('category/delete/{id}', 'destroy')->name('category.destroy');
    Route::get('category/{id}/status', 'status')->name('category.status');
    Route::get('category/active_all_status', 'active_all_status')->name('category.active_all_status');
    Route::get('category/deactive_all_status', 'deactive_all_status')->name('category.deactive_all_status');
    Route::get('category/delete_all', 'delete_all')->name('category.delete.all');
    Route::get('category/export-categories', 'export')->name('category.export');
    Route::post('category/import-categories', 'import')->name('category.import');
});


}); 

Route::middleware(['auth'])->group(function(){
    Route::get('/', [MainController::class, 'index'])->name('home');
    Route::get('/shop', [MainController::class, 'shop'])->name('shop');
    Route::get('/about', [MainController::class, 'about'])->name('about');
    Route::get('/contact', [MainController::class, 'contact'])->name('contact');
    Route::get('/cart', [MainController::class, 'cart'])->name('cart');
    Route::get('/product/{slug}',[MainController::class, 'product_detail'])->name('product-detail');
    Route::get('/category/{slug}',[MainController::class, 'category_detail'])->name('category-detail');

    Route::get('/user-profile', [UserController::class, 'index'])->name('user.index'); 
    Route::get('/user-orders', [UserController::class, 'orders'])->name('user.order'); 
    Route::put('/user/profile/', [UserController::class, 'user_profile'])->name('user.profile');
    Route::get('/user-orders/{order_id}/detail', [UserController::class, 'order_detail'])->name('user.order.detail');  
    Route::get('/order-confirm',[UserController::class, 'order_confirmations'])->name('cart.order.confirms');

    Route::get('/user/payout/requests', [PayoutRequestController::class, 'index'])->name('user.payout');
    Route::get('/user/payout/create', [PayoutRequestController::class, 'create'])->name('user.payout.create');
    Route::post('/user/payout/store', [PayoutRequestController::class, 'store'])->name('user.payout.store');
    Route::get('/transaction-history/{userId}', [PayoutRequestController::class, 'generateTransactionHistory'])
    ->name('transaction.history'); 
    Route::get('/orders-history/{userId}', [PayoutRequestController::class, 'generateOrdersHistory'])
    ->name('orders.history');


    Route::post('/cart/add', [CartController::class, 'store'])->name('cart.add');
    Route::put('cart/quantity/decrease/{rowId}', [CartController::class, 'decreaseQuantity'])->name('cart.quantity.decrease');
    Route::put('cart/quantity/increase/{rowId}', [CartController::class, 'increaseQuantity'])->name('cart.quantity.increase');
    Route::delete('/cart/remove/{rowId}', [CartController::class, 'remove_item'])->name('cart.item.remove');
    Route::delete('/cart/clear', [CartController::class, 'empty_cart'])->name('cart.clear');
    Route::get('/checkout',[CartController::class, 'checkout'])->name('checkout');
    Route::post('/place-an-order',[CartController::class, 'place_an_order'])->name('place.order'); 
});

    