<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\Auth\Api\PasswordControllerApi;
use App\Http\Controllers\Auth\Api\RegisteredUserControllerApi;
use App\Http\Controllers\Auth\Api\PasswordResetLinkControllerApi;
use App\Http\Controllers\Auth\Api\AuthenticatedSessionControllerApi;

Route::post('login', [AuthenticatedSessionControllerApi::class, 'store']);
Route::post('register', [RegisteredUserControllerApi::class, 'store']);
Route::post('forgot-password', [PasswordResetLinkControllerApi::class, 'store']);
Route::post('reset-password', [PasswordControllerApi::class, 'store']);

Route::get('stores/{id}/products', [ProductController::class, 'index']);
Route::get('products/{id}', [ProductController::class, 'show']);

Route::get('stores', [StoreController::class, 'index']);
Route::get('stores/{id}', [StoreController::class, 'show']);

Route::get('companies', [CompanyController::class, 'index']);
Route::get('companies/{id}', [CompanyController::class, 'show']);

Route::middleware(['auth:sanctum'])->group(function () {
    // Admin
    Route::post('companies', [CompanyController::class, 'store']);
    Route::put('companies/{id}', [CompanyController::class, 'update']);
    Route::delete('companies/{id}', [CompanyController::class, 'destroy']);

    // Admin
    Route::post('stores', [StoreController::class, 'store']);
    Route::delete('stores/{id}', [StoreController::class, 'destroy']);
    Route::put('stores/{id}', [StoreController::class, 'update']);    

    // Manager
    Route::post('stores/{id}/products', [ProductController::class, 'store']);
    Route::put('products/{id}', [ProductController::class, 'update']);
    Route::delete('products/{id}', [ProductController::class, 'destroy']);

    // Customer
    Route::post('purchase/{id}', [PurchaseController::class, 'purchase']);
    
    Route::post('logout', [AuthenticatedSessionControllerApi::class, 'destroy']);
});
