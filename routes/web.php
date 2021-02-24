<?php

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

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name("home");

Route::group(['prefix' => 'products'], function () {

    Route::get("{categorySlug}", [\App\Http\Controllers\ProductController::class, "index"])->name('category-list');

    Route::get("{categorySlug}/{productId}", [\App\Http\Controllers\ProductController::class, "show"])->name('category-page');

});

Route::group(['prefix' => 'cart'], function() {

    Route::post("/", [\App\Http\Controllers\CartController::class, "store"])->name('cart-store');

    Route::get("/", [\App\Http\Controllers\CartController::class, "index"])->name('cart-index');

    Route::delete("{productId}", [\App\Http\Controllers\CartController::class, "destroy"])->name("cart-destroy");

    Route::put("{productId}", [\App\Http\Controllers\CartController::class, "update"])->name("cart-update");

});

Route::middleware(['auth:sanctum', 'verified'])->prefix("admin")->group( function () {

    Route::resource("categories", \App\Http\Controllers\Admin\CategoryController::class);

    Route::resource("products", \App\Http\Controllers\Admin\ProductController::class);

});

