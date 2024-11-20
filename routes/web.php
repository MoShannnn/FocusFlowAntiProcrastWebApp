<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;

    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'storeLogin'])->name('user.login');

    Route::get('/signup', [AuthController::class, 'signup'])->name('signup');
    Route::post('/signup', [AuthController::class, 'create'])->name('user.create');

    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
