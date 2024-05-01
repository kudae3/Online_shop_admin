<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\PermissionMiddleware;
use Illuminate\Support\Facades\Route;


Route::middleware(PermissionMiddleware::class)->group(function(){
    Route::redirect('/', 'loginPage');
    Route::get('/loginPage', [AuthController::class, 'login'])->name('loginPage');
    Route::get('/registerPage', [AuthController::class, 'register'])->name('registerPage');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function(){
        return redirect ('/category/list');
    });

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
    });


});
