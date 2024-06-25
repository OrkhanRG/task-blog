<?php

use Illuminate\Support\Facades\Route;

//admin
use App\Http\Controllers\Admin\DashboardController;
//auth
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

/*
 *
 *
 * */

Route::prefix('admin')->middleware('auth')->as('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');
});

Route::prefix('login')->group(function (){
    Route::get('/', [LoginController::class, 'loginShow'])->name('login');
    Route::post('/', [LoginController::class, 'login']);
});

Route::prefix('register')->group(function (){
    Route::get('/', [RegisterController::class, 'registerShow'])->name('register');
    Route::post('/', [RegisterController::class, 'register']);
});
