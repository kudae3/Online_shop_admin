<?php

use App\Http\Controllers\Api\AccountController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Auth
Route::post('/login', [AuthController::class, 'userLogin']);
Route::post('/register', [AuthController::class, 'userRegister']);
Route::get('/get/user', [AuthController::class, 'getUser'])->middleware('auth:sanctum');

//Account
Route::post('/account/edit', [AccountController::class, 'editAccount']);

//category
Route::get('/get/categories', [CategoryController::class, 'categoryList']);
Route::get('/filter/category', [CategoryController::class, 'filterCategory']);

//Products
Route::get('/get/products', [ProductController::class, 'productList']);
Route::get('/search/product', [ProductController::class, 'searchProduct']);
Route::get('/detail/product', [ProductController::class, 'productDetail']);

//cart
Route::post('/add/cart', [CartController::class, 'addtoCart']);
Route::get('/view/cart', [CartController::class, 'viewCart']);
Route::post('/delete/cart', [CartController::class, 'deleteCart']);

//order
Route::post('/add/order', [OrderController::class, 'addOrder']);
Route::get('/view/order', [OrderController::class, 'orderList']);


