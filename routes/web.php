<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [ProductController::class,'index'])->name('shop.index');
Route::get('/cart', [ProductController::class,'cart'])->name('keranjang');

Route::get('/detail/{id}',[ProductController::class,'detail'])->name('detail.product');

// Route::get('/login',function(){
//   return view('auth.login');
// })->name('login');


// Route::get('/register',function(){
//   return view('auth.register');
// })->name('register');


// Public routes
Route::get('/login', [CustomerController::class, 'showLoginForm'])->name('login.index');
Route::post('/login', [CustomerController::class, 'login'])->name('login.store');
Route::get('/register', [CustomerController::class, 'showRegisterForm'])->name('register.index');
Route::post('/register', [CustomerController::class, 'register'])->name('register.store');

// Protected routes
Route::middleware('auth:customers')->group(function () {
    Route::get('/checkout', [CustomerController::class, 'checkout'])->name('checkout');
    Route::post('/logout', [CustomerController::class, 'logout'])->name('logout');
});
