<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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

Route::get('/', [ProductController::class,'index']);
Route::get('/cart', [ProductController::class,'cart']);

Route::get('/detail/{id}',[ProductController::class,'detail'])->name('detail.product');

Route::get('/login',function(){
  return view('auth.login');
})->name('login');


Route::get('/register',function(){
  return view('auth.register');
})->name('register');
