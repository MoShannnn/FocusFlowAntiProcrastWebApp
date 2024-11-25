<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AuthController;

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'storeLogin'])->name('user.login');

    Route::get('/signup', [AuthController::class, 'signup'])->name('signup');
    Route::post('/signup', [AuthController::class, 'create'])->name('user.create');
});

Route::get('/', [PageController::class, 'index'])->name('home');

Route::get('/settings', [PageController::class, 'settings'])->name('settings');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/reset-password', [AuthController::class, 'resetPassword'])->name('resetPassword');

Route::post('/reset-password', [AuthController::class, 'updatePassword'])->name('updatePassword');
