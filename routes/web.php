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

    Route::get("{categorySlug}", [\App\Http\Controllers\ProductController::class, "index"])->name('product-list');

    Route::get("{categorySlug}/{productId}", [\App\Http\Controllers\ProductController::class, "show"])->name('product-page');

});
