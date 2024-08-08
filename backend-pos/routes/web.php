<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\SupplyController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware('auth', 'verified'  )->group(function () {

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/brand',[BrandController::class , 'index'])->name('pos.brand');
Route::post('/brand/create',[BrandController::class , 'createBrand'])->name('pos.create');
Route::post('/brand/{id}',[BrandController::class , 'deleteBrand'])->name('pos.delete');

Route::get('/categories',[CategoryController::class , 'index'])->name('category.index');
Route::post('/category/create',[CategoryController::class , 'createCategory'])->name('category.create');
Route::post('/category/{id}',[CategoryController::class , 'deleteCategory'])->name('category.delete');

Route::get('/suppliers',[SupplyController::class , 'index'])->name('supplier.index');
Route::post('/suppliers/create',[SupplyController::class , 'createSupplier'])->name('supplier.create');
Route::post('/suppliers/{id}',[SupplyController::class , 'deleteSupplier'])->name('supplier.delete');
Route::get('/suppliers/{id}/edit',[SupplyController::class , 'getSingleSupplier'])->name('supplier.get');
Route::put('/suppliers/{id}/update',[SupplyController::class , 'updateSupplier'])->name('supplier.update');

Route::get('/users',[UserController::class , 'index'])->name('user.index');
Route::post('/users/create',[UserController::class , 'store'])->name('user.store');
Route::post('/users/{id}',[UserController::class , 'deleteUser'])->name('user.delete');
Route::get('/users/{id}/edit',[UserController::class , 'getSingleUser'])->name('user.get');
Route::put('/users/{id}/update',[UserController::class , 'updateUser'])->name('user.update');

Route::get('/products',[ProductController::class , 'index'])->name('product.index');
Route::post('/products/create' , [ProductController::class , 'create'])->name('product.create');
Route::post('/products/{product}' , [ProductController::class , 'deleteProduct'])->name('product.delete');
Route::get('/products/{id}/edit' , [ProductController::class , 'getSingleProduct'])->name('product.get');
Route::put('/products/{id}/update' , [ProductController::class , 'updateProduct'])->name('product.update');

/**
 * filepond Upload
 * api Route
 */
Route::post('/upload' ,[UploadController::class , 'store']);
Route::delete('/destory' ,[UploadController::class , 'destory']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
