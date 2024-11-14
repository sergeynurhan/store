<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::post('login', [AuthenticatedSessionController::class, 'store']);
Route::post('register', [RegisteredUserController::class, 'store']);
Route::post('forgot-password', [PasswordResetLinkController::class, 'store']);
Route::post('reset-password', [PasswordController::class, 'store']);

Route::get('stores/{id}/products', [ProductController::class, 'index']);
Route::get('products/{product}', [ProductController::class, 'show']);

Route::get('stores', [StoreController::class, 'index']);
Route::get('stores/{store}', [StoreController::class, 'show']);

Route::get('companies', [CompanyController::class, 'index']);
Route::get('companies/{company}', [CompanyController::class, 'show']);

Route::middleware(['auth:sanctum'])->group(function () {

    Route::middleware(['role:admin'])->group(function () {

        Route::post('companies', [CompanyController::class, 'store']);
        Route::put('companies/{company}', [CompanyController::class, 'update']);
        Route::delete('companies/{company}', [CompanyController::class, 'destroy']);

        Route::post('stores', [StoreController::class, 'store']);
        Route::delete('stores/{store}', [StoreController::class, 'destroy']);
        Route::put('stores/{store}', [StoreController::class, 'update']);    

    });

    Route::middleware(['role:manager'])->group(function () {

        Route::post('stores/{store}/products', [ProductController::class, 'store']);
        Route::put('products/{product}', [ProductController::class, 'update']);
        Route::delete('products/{product}', [ProductController::class, 'destroy']);

    });

    Route::middleware(['role:customer'])->group(function () {

        Route::post('purchase/{product}', [PurchaseController::class, 'purchase']);

    });

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy']);
});
