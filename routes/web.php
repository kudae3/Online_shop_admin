<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FavouriteController;
use App\Http\Middleware\PermissionMiddleware;


Route::middleware(PermissionMiddleware::class)->group(function(){
    Route::redirect('/', 'loginPage');
    Route::get('/loginPage', [AuthController::class, 'login'])->name('loginPage');
});

Route::middleware(['auth'])->group(function () {

    Route::prefix('category')->group(function(){
        Route::get('/list', [CategoryController::class, 'categoryView'])->name('category#list');
        Route::get('/create', [CategoryController::class, 'createCategory'])->name('category#create');
        Route::post('/create', [CategoryController::class, 'createBtn'])->name('category#createBtn');
        Route::get('/delete/{id}', [CategoryController::class, 'deleteCategory'])->name('category#delete');
        Route::get('/edit/{id}', [CategoryController::class, 'editCategory'])->name('category#edit');
        Route::post('/update/{id}', [CategoryController::class, 'updateBtn'])->name('category#updateBtn');
    });

    Route::prefix('product')->group(function(){
        Route::get('/list', [ProductController::class, 'productView'])->name('product#list');
        Route::get('/list/search', [ProductController::class, 'productSearch'])->name('product#search');
        Route::get('/list/filter', [ProductController::class, 'productFilter'])->name('product#filter');
        Route::get('/create', [ProductController::class, 'createProduct'])->name('product#create');
        Route::post('/create', [ProductController::class, 'createBtn'])->name('product#createBtn');
        Route::get('/delete/{id}', [ProductController::class, 'deleteProduct'])->name('product#delete');
        Route::get('/edit/{id}', [ProductController::class, 'editProduct'])->name('product#edit');
        Route::post('/update/{id}', [ProductController::class, 'updateBtn'])->name('product#updateBtn');
        Route::get('/detail/{id}', [ProductController::class, 'viewProduct'])->name('product#detail');
    });

    Route::prefix('user')->group(function(){
        Route::get('/list', [UserController::class, 'userView'])->name('user#list');
        Route::post('/switch/admin', [UserController::class, 'switchAdmin'])->name('user#switchAdmin');
        Route::post('/delete', [UserController::class, 'deleteUser'])->name('user#delete');
    });

    Route::prefix('admin')->group(function(){
        Route::get('/list', [AdminController::class, 'adminView'])->name('admin#list');
        Route::post('/switch/user', [AdminController::class, 'switchUser'])->name('admin#switchUser');
    });

    Route::prefix('order')->group(function(){
        Route::get('/list', [OrderController::class, 'orderView'])->name('order#list');
        Route::post('/changeStatus', [OrderController::class, 'changeStatus'])->name('order#changeStatus');
    });

    Route::prefix('favourite')->group(function(){
        Route::get('/list', [FavouriteController::class, 'favView'])->name('fav#list');
    });

    Route::prefix('account')->group(function(){
        Route::get('/profile', [AccountController::class, 'ProfileView'])->name('account#profile');
        Route::get('/edit', [AccountController::class, 'EditBtn'])->name('account#editBtn');
        Route::post('/save/edit', [AccountController::class, 'SaveBtn'])->name('account#saveBtn');
        Route::get('change/password', [AccountController::class, 'changePassword'])->name('account#changePassword');
        Route::post('/password/confirm', [AccountController::class, 'confirmBtn'])->name('account#confirmPassBtn');
    });

});
