<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\RoleController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//login
Route::post('/admin/login', [AuthController::class,'login']);
Route::post('/admin/password/request', [AuthController::class, 'sendResetLinkEmail']);
//user
Route::get('/data/users', [UserController::class,'showdata']);
Route::post('/data/users-create', [UserController::class,'store']);
Route::get('/data/{id}/users-edit', [UserController::class,'edit']);
Route::put('/data/{id}/users', [UserController::class,'update']);
Route::delete('/data/users/{id}', [UserController::class, 'destroy']);

//product
Route::get('/data/products', [ProductController::class,'showdata']);
Route::post('/data/products-create', [ProductController::class,'store']);
Route::get('/data/{id}/products-edit', [ProductController::class,'edit']);
Route::put('/data/{id}/products', [ProductController::class,'update']);
Route::delete('/data/products/{id}', [ProductController::class, 'destroy']);
Route::post('/data/products/delete-selected', [ProductController::class,'deleteSelected']);
//category
Route::get('/data/categories', [CategoryController::class,'showdata']);
Route::post('/data/categories-create', [CategoryController::class,'store']);
Route::get('/data/{id}/categories-edit', [CategoryController::class,'edit']);
Route::put('/data/{id}/categories', [CategoryController::class,'update']);
Route::delete('/data/categories/{id}', [CategoryController::class, 'destroy']);


Route::get('/data/roles', [RoleController::class,'showdata']);
