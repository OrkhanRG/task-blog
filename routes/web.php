<?php

use Illuminate\Support\Facades\Route;

//admin
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\CategoryController;
//auth
use App\Http\Controllers\Auth\LoginController;

/*
 *
 *
 * */

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->middleware('auth')->name('admin.')->group(function () {

    //dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('index');

    //blog

    //category
    Route::prefix('/category')->name('category.')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('/create', [CategoryController::class, 'create'])->name('create');
        Route::post('/create', [CategoryController::class, 'store']);
        Route::get('/edit/{category}', [CategoryController::class, 'edit'])->name('update');
        Route::patch('/edit/{category}', [CategoryController::class, 'update']);
        Route::delete('/delete/', [CategoryController::class, 'delete'])->name('delete');
        Route::delete('/change-status/', [CategoryController::class, 'changeStatus'])->name('change-status');
    });

    //tags
});

Route::prefix('login')->middleware('guest')->group(function () {
    Route::get('/', [LoginController::class, 'loginShow'])->name('login');
    Route::post('/', [LoginController::class, 'login']);
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
