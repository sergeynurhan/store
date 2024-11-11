<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\Api\NewPasswordControllerApi;
use App\Http\Controllers\Auth\Api\RegisteredUserControllerApi;
use App\Http\Controllers\Auth\Api\PasswordResetLinkControllerApi;
use App\Http\Controllers\Auth\Api\AuthenticatedSessionControllerApi;
use App\Http\Controllers\Auth\Api\EmailVerificationNotificationControllerApi;

Route::post('/register', [RegisteredUserControllerApi::class, 'store'])
                ->middleware('guest')
                ->name('register');

Route::post('/login', [AuthenticatedSessionControllerApi::class, 'store'])
                ->middleware('guest')
                ->name('login');

Route::post('/forgot-password', [PasswordResetLinkControllerApi::class, 'store'])
                ->middleware('guest')
                ->name('password.email');

Route::post('/reset-password', [NewPasswordControllerApi::class, 'store'])
                ->middleware('guest')
                ->name('password.store');

Route::get('/verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['auth', 'signed', 'throttle:6,1'])
                ->name('verification.verify');

Route::post('/email/verification-notification', [EmailVerificationNotificationControllerApi::class, 'store'])
                ->middleware(['auth', 'throttle:6,1'])
                ->name('verification.send');

Route::post('/logout', [AuthenticatedSessionControllerApi::class, 'destroy'])
                ->middleware('auth')
                ->name('logout');
