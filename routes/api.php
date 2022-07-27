<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Authentication
Route::prefix('auth')->group(function () {
    Route::post('register', [App\Http\Controllers\Api\AuthController::class, 'register']);
    Route::post('login', [App\Http\Controllers\Api\AuthController::class, 'login']);
    Route::get('refresh', [App\Http\Controllers\Api\AuthController::class, 'refresh']);
    Route::middleware('auth:api')->group(function() {
        Route::get('me', [App\Http\Controllers\Api\AuthController::class, 'index']);
        Route::post('logout', [App\Http\Controllers\Api\AuthController::class, 'logout']);
    });
});

// User
Route::prefix('users')->middleware('auth:api')->group(function () {
    Route::get('index', [App\Http\Controllers\Api\UserController::class, 'index']);
    Route::get('profile', [App\Http\Controllers\Api\UserController::class, 'profile']);
    Route::get('list', [App\Http\Controllers\Api\UserController::class, 'list']);
    Route::post('update', [App\Http\Controllers\Api\UserController::class, 'update']);
    Route::post('remove', [App\Http\Controllers\Api\UserController::class, 'destroy']);
});

// Category
Route::prefix('category')->middleware('auth:api')->group(function () {
    Route::get('list', [App\Http\Controllers\Api\CategoryController::class, 'list']);
    Route::get('index', [App\Http\Controllers\Api\CategoryController::class, 'index']);
    Route::post('add', [App\Http\Controllers\Api\CategoryController::class, 'store']);
    Route::post('update', [App\Http\Controllers\Api\CategoryController::class, 'update']);
    Route::post('remove', [App\Http\Controllers\Api\CategoryController::class, 'destroy']);
});

// Restaurant
Route::prefix('restaurant')->middleware('auth:api')->group(function () {
    Route::get('list', [App\Http\Controllers\Api\RestaurantController::class, 'list']);
    Route::get('index', [App\Http\Controllers\Api\RestaurantController::class, 'index']);
    Route::post('add', [App\Http\Controllers\Api\RestaurantController::class, 'store']);
    Route::post('update', [App\Http\Controllers\Api\RestaurantController::class, 'update']);
    Route::post('remove', [App\Http\Controllers\Api\RestaurantController::class, 'destroy']);
});


// Product
Route::prefix('product')->middleware('auth:api')->group(function () {
    Route::get('list', [App\Http\Controllers\Api\ProductController::class, 'list']);
    Route::get('index', [App\Http\Controllers\Api\ProductController::class, 'index']);
    Route::post('add', [App\Http\Controllers\Api\ProductController::class, 'store']);
    Route::post('update', [App\Http\Controllers\Api\ProductController::class, 'update']);
    Route::post('remove', [App\Http\Controllers\Api\ProductController::class, 'destroy']);
});

// Cart
Route::prefix('cart')->middleware('auth:api')->group(function () {
    Route::get('index', [App\Http\Controllers\Api\CartController::class, 'index']);
    Route::post('add_product', [App\Http\Controllers\Api\CartController::class, 'addProduct']);
    Route::post('update_product', [App\Http\Controllers\Api\CartController::class, 'updateProduct']);
    Route::post('remove_product', [App\Http\Controllers\Api\CartController::class, 'removeProduct']);
});

// Order
Route::prefix('order')->middleware('auth:api')->group(function () {
    Route::get('list', [App\Http\Controllers\Api\OrderController::class, 'list']);
    Route::get('detail', [App\Http\Controllers\Api\OrderController::class, 'detail']);
    Route::post('create', [App\Http\Controllers\Api\OrderController::class, 'create']);
    Route::post('updateStatus', [App\Http\Controllers\Api\OrderController::class, 'updateStatus']);
    Route::post('updateShipping', [App\Http\Controllers\Api\OrderController::class, 'updateShipping']);
    // Payment
    Route::get('get_intent', [App\Http\Controllers\Api\OrderController::class, 'getStripeIntent']);
});

// Address
Route::prefix('address')->middleware('auth:api')->group(function () {
    Route::post('getAddress', [App\Http\Controllers\Api\AddressController::class, 'getAddressFromCoordinate']);
    Route::get('list', [App\Http\Controllers\Api\AddressController::class, 'list']);
});

