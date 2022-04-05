<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\CategoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('products', [ProductController::class, 'all']);
Route::get('categories', [CategoryController::class, 'all']);

Route::get('user', [UserController::class, 'fetch'])->middleware('auth:sanctum');
Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);