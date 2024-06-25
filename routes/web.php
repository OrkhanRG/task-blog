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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->middleware('auth')->as('admin.')->group(function () {

    //dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('index');

    //blog

    //category

    //tags
});

Route::prefix('login')->middleware('guest')->group(function () {
    Route::get('/', [LoginController::class, 'loginShow'])->name('login');
    Route::post('/', [LoginController::class, 'login']);
});

Route::prefix('register')->middleware('guest')->group(function () {
    Route::get('/', [RegisterController::class, 'registerShow'])->name('register');
    Route::post('/', [RegisterController::class, 'register']);
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
