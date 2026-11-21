<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController; 

Route::get('/', function () {
    return view('welcome');
});
// dashboard route
Route::get('/dashboard', [DashboardController::class, 'index'])->name('index');
