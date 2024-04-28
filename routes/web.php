<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Middleware\PermissionMiddleware;
use Illuminate\Support\Facades\Route;


Route::middleware(PermissionMiddleware::class)->group(function(){
    Route::redirect('/', 'loginPage');
    Route::get('/loginPage', [AuthController::class, 'login'])->name('loginPage');
    Route::get('/registerPage', [AuthController::class, 'register'])->name('registerPage');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function(){
        return redirect ('/category');
    });

    Route::get('/category', [CategoryController::class, 'categoryView'])->name('categoryView');

});
