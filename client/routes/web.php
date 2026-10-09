<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthManager;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\TruckController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TypepaymentController;

Route::get('/', function () {
    return view('index');
})->name('home');
// Route::get('/menu', function () {
//     return view('menu');
// })->name('menu');

Route::get('/menu', [ProductController::class, 'index'])->name('menu');
Route::get('listStock', [ProductController::class, 'getJoinedStocks'])->name('listStock');
Route::get('/menu-item/{id}', [ProductController::class, 'show'])->name('quickview');

Route::post('/cart/add/{menuId}', [CartController::class, 'addToCart']);
Route::post('/cart/update-quantity', [CartController::class, 'updateQuantity']);
Route::post('/cart/remove', [CartController::class, 'removeItem'])->name('cart.remove');



Route::get('/cart/list', [CartController::class, 'getCart']);
Route::post('/cart/add', [CartController::class, 'addToCart']);

Route::get('/trucks/available', [TruckController::class, 'availableTrucks']);


Route::get('/orders', [OrderController::class, 'store']);





Route::get('/login', [AuthManager::class,'login'])->name('login');
Route::post('/login', [AuthManager::class,'loginOrRegister'])->name('login.post');
Route::get('/logout', [AuthManager::class,'logout'])->name('logout');
Route::get('/profile', function () {
    if (Auth::check()) {
        return view('profile');
    } else {
        return redirect()->route('login');
    }
})->name('profile');


Route::get('/checkout', function () {
    return view('checkout');
})->name('checkout');

Route::get('/menu_detail', function () {
    return view('menu_detail');
})->name('menu_detail');

// Route::get('/profile', function () {
//     return view('profile');
// })->name('profile');

Route::get('/wishlist', function () {
    return view('wishlist');
})->name('wishlist');
