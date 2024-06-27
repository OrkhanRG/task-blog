<?php

use Illuminate\Support\Facades\Route;
//admin
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\NewsController;
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
    Route::prefix('/news')->name('news.')->group(function () {
        Route::get('/', [NewsController::class, 'index'])->name('index');
        Route::get('/create', [NewsController::class, 'create'])->name('create');
        Route::post('/create', [NewsController::class, 'store']);
        Route::get('/edit/{news}', [NewsController::class, 'edit'])->name('update');
        Route::patch('/edit/{news}', [NewsController::class, 'update']);
        Route::delete('/delete/', [NewsController::class, 'delete'])->name('delete');
        Route::patch('/change-status/', [NewsController::class, 'changeStatus'])->name('change-status');
    });

    //category
    Route::prefix('/category')->name('category.')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('/create', [CategoryController::class, 'create'])->name('create');
        Route::post('/create', [CategoryController::class, 'store']);
        Route::get('/edit/{category}', [CategoryController::class, 'edit'])->name('update');
        Route::patch('/edit/{category}', [CategoryController::class, 'update']);
        Route::delete('/delete/', [CategoryController::class, 'delete'])->name('delete');
        Route::patch('/change-status/', [CategoryController::class, 'changeStatus'])->name('change-status');
    });

    //tags
    Route::prefix('/tag')->name('tag.')->group(function () {
        Route::get('/', [TagController::class, 'index'])->name('index');
        Route::get('/create', [TagController::class, 'create'])->name('create');
        Route::post('/create', [TagController::class, 'store']);
        Route::get('/edit/{tag}', [TagController::class, 'edit'])->name('update');
        Route::patch('/edit/{tag}', [TagController::class, 'update']);
        Route::delete('/delete/', [TagController::class, 'delete'])->name('delete');
        Route::patch('/change-status/', [TagController::class, 'changeStatus'])->name('change-status');
    });
});

Route::prefix('login')->middleware('guest')->group(function () {
    Route::get('/', [LoginController::class, 'loginShow'])->name('login');
    Route::post('/', [LoginController::class, 'login']);
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
