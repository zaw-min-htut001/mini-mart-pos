<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductsController;

Route::get('/products', [ProductsController::class , 'index']);
Route::get('/categories', [ProductsController::class , 'categories']);

