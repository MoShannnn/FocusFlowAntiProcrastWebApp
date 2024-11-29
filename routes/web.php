<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TimerSessionLogController;

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'storeLogin'])->name('user.login');

    Route::get('/signup', [AuthController::class, 'signup'])->name('signup');
    Route::post('/signup', [AuthController::class, 'create'])->name('user.create');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', [PageController::class, 'index'])->name('home');

// Setting & Profile
Route::get('/settings', [UserController::class, 'settings'])->name('settings');

Route::post('/update-profile', [UserController::class, 'updateProfile'])->name('updateProfile');

// Reset Password
Route::get('/reset-password', [UserController::class, 'resetPassword'])->name('resetPassword');

Route::post('/reset-password', [UserController::class, 'updatePassword'])->name('updatePassword');

// Task 
Route::resource('categories', CategoryController::class);

Route::resource('tasks', TaskController::class);

Route::resource('timers', TimerSessionLogController::class);

Route::resource('posts', PostController::class);

