<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\InvoiceController;
use App\Http\Controllers\Api\ProductsController;

Route::middleware('auth:sanctum')->group(function(){
    Route::post('/logout' , [AuthController::class , 'logout']);

    Route::get('/products', [ProductsController::class , 'index']);
    Route::get('/categories', [ProductsController::class , 'categories']);
    Route::get('/getSingleProduct/{product}', [ProductsController::class , 'getSingleProduct']);

    Route::post('/invoice', [InvoiceController::class , 'checkout']);


});

Route::post('/login' , [AuthController::class , 'login']);
