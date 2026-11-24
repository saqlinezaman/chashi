<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController; 
use App\Http\Controllers\productController; 
use App\Http\Controllers\bannerController; 

Route::get('/', function () {
    return view('welcome');
})->name('website');

// dashboard route-------------------------------------------------------------------------------------------
Route::get('/dashboard', [DashboardController::class, 'index'])->name('index');
//banner route-----------------------------------------------------------------------------------------------
Route::get('banner', [bannerController::class, 'index'])->name('banner');
//product route ---------------------------------------------------------------------------------------------
Route::get('product', [productController::class, 'index'])->name('product');
