<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'login_proses'])->name('login_proses');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/like', [HomeController::class, 'like'])->name('like');

Route::post('/get-data', [HomeController::class, 'get_data'])->name('get_data');

Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('buku', BukuController::class);
});
