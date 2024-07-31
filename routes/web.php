<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\User\cartController;
use App\Models\CartItem;
use Illuminate\Support\Facades\Route;


//Admin routes
Route::prefix('admin')->name('admin')->group(function(){
    Route::resource('products', ProductController::class);
});


//User Routes
Route::get('cart',[cartController::class, 'index'])->name('cart.index');
Route::post('cart',[cartController::class, 'store'])->name('cart.store');
Route::Put('cart/{CartItem}', [cartController::class,  'update'])->name('cart.update');
Route::Put('cart/{CartItem}', [cartController::class,  'destroy'])->name('cart.destroy');


