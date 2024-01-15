<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/catalogs', [CatalogController::class, 'index'])->name('catalog.index');
Route::get('/catalogs/{id}', [CatalogController::class, 'show'])->name('catalog.show');
Route::post('/cart/add/{product}', [CatalogController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::delete('/cart/{id}', [CartController::class, 'deleteCartItem'])->name('cart.delete');
Route::get('/transaction', [TransactionController::class, 'showTransactionForm'])->name('transaction.show');
Route::post('/transaction', [TransactionController::class, 'processTransaction'])->name('transaction.process');
