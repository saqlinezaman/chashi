<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController; 
use App\Http\Controllers\productController; 

Route::get('/', function () {
    return view('welcome');
})->name('website');
// dashboard route
Route::get('/dashboard', [DashboardController::class, 'index'])->name('index');
// product route 
Route::get('product', [productController::class, 'index'])->name('product');
