<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\bannerController;
use App\Http\Controllers\productController;
use App\Http\Controllers\DashboardController; 

Route::get('/', function () {
    $banners = \App\Models\Banner::where('is_active', 1)->latest()->get();
    return view('welcome',compact('banners'));
})->name('website');

// dashboard route-------------------------------------------------------------------------------------------
Route::get('/dashboard', [DashboardController::class, 'index'])->name('index');
//banner route-----------------------------------------------------------------------------------------------
Route::get('banner', [bannerController::class, 'index'])->name('banner');
Route::post('banner/store', [bannerController::class, 'store'])->name('banner.store');
Route::put('banner/{banner}', [bannerController::class, 'update'])->name('banner.update');
Route::delete('banner/{banner}', [bannerController::class, 'destroy'])->name('banner.destroy');
//product route ---------------------------------------------------------------------------------------------
Route::get('product', [productController::class, 'index'])->name('product');
