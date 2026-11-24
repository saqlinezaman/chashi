<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController; 
use App\Http\Controllers\productController; 
use App\Http\Controllers\bannerController; 

Route::get('/', function () {
    $banners = \App\Models\Banner::where('is_active', 1)->latest()->get();
    return view('welcome',compact('banners'));
})->name('website');

// dashboard route-------------------------------------------------------------------------------------------
Route::get('/dashboard', [DashboardController::class, 'index'])->name('index');
//banner route-----------------------------------------------------------------------------------------------
Route::get('banner', [bannerController::class, 'index'])->name('banner');
Route::post('banner/store', [bannerController::class, 'store'])->name('banner.store');
//product route ---------------------------------------------------------------------------------------------
Route::get('product', [productController::class, 'index'])->name('product');
