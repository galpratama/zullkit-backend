<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SubscriptionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
   
    Route::name('dashboard.')->prefix('dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('index');

        Route::middleware(['admin'])->group(function () {
            Route::resource('product', ProductController::class);
            Route::resource('product.gallery', GalleryController::class)->shallow()->only([
                'index', 'create', 'store', 'destroy'
            ]);
            Route::resource('category', CategoryController::class);
            Route::resource('subscription', SubscriptionController::class)->only([
                'index', 'show', 'edit', 'update'
            ]);
        });
    });
});