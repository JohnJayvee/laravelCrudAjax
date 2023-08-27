<?php

use App\Http\Controllers\ProductController;
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
// Route::resource('products-ajax-crud', ProductController::class);

    Route::get('/products-ajax-crud', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products-ajax-crud/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::post('/products-ajax-crud/store/', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products-ajax-crud/show/{id}', [ProductController::class, 'show'])->name('products.show');
    Route::delete('/products-ajax-crud/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
