<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// Halaman utama sekarang langsung ke login (bukan welcome lagi)
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.proses');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Halaman produk hanya bisa diakses setelah login
Route::middleware('auth')->group(function () {
    Route::resource('products', ProductController::class);
});
