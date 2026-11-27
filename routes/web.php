<?php

use App\Http\Controllers\BannerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController; 
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $banners = \App\Models\Banner::where('is_active', 1)->latest()->get();
    $categories = \App\Models\Category::where('is_active', 1)->latest()->get();
    return view('welcome',compact('banners', 'categories'));
})->name('website');

// dashboard route-------------------------------------------------------------------------------------------

Route::get('/dashboard', [DashboardController::class, 'index'])->name('index');

//banner route-----------------------------------------------------------------------------------------------

Route::get('banner', [BannerController::class, 'index'])->name('banner');
Route::post('banner/store', [BannerController::class, 'store'])->name('banner.store');
Route::put('banner/{banner}', [BannerController::class, 'update'])->name('banner.update');
Route::delete('banner/{banner}', [BannerController::class, 'destroy'])->name('banner.destroy');

// categories route ----------------------------------------------------------------------------------------

Route::get('categories', [CategoryController::class, 'index'])->name('categories');
Route::post('category/store', [CategoryController::class, 'store'])->name('category.store');
Route::put('category/{category}', [CategoryController::class, 'update'])->name('category.update');
Route::delete('category/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');

//product route ---------------------------------------------------------------------------------------------

Route::get('product', [ProductController::class, 'index'])->name('product');
