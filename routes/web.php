<?php


use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

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
    return redirect()->route('show_all_product');
});


Route::get('/shop',[ProductController::class,'index'])->name('show_all_product');
Route::get('/shopping-cart/show',[CartController::class,'show'])->name('show_shopping_cart');

Route::post('/add-to-cart', [CartController::class,'add'])->name('add-to-cart');
Route::post('/remove_cart', [CartController::class,'remove'])->name('remove_cart');
