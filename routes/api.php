<?php

use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\ShopBrandsController;
use App\Http\Controllers\API\ShopCustomersController;
use App\Http\Controllers\API\ShopProductsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Public Routes
Route::post('/login', [AuthController::class,'login']);
Route::post('/register', [AuthController::class,'register']);

//Protected Routes
Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::resource('/shop_products', ShopProductsController::class);
    Route::resource('/shop_brands', ShopBrandsController::class);
    Route::resource('/shop_customers', ShopCustomersController::class);
    Route::post('/shop_products/{product}/upload-image', [ShopProductsController::class, 'uploadImage']);

    Route::post('/logout', [AuthController::class,'logout']);
});

