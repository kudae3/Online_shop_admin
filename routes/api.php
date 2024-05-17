<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Auth
Route::post('/login', [AuthController::class, 'userLogin']);
Route::post('/register', [AuthController::class, 'userRegister']);

//category
Route::get('/get/categories', [CategoryController::class, 'categoryList']);
Route::get('/filter/category', [CategoryController::class, 'filterCategory']);

//Products
Route::get('/get/products', [ProductController::class, 'productList']);
Route::get('/search/product', [ProductController::class, 'searchProduct']);
Route::get('/detail/product', [ProductController::class, 'productDetail']);


