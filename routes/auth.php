<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Guest Routes
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('/register', [RegisteredUserController::class, 'store'])
        ->name('register.store');

    // Session Management
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.attempt');
});

// Protected Authentication & Verification Routes
Route::middleware('auth')->group(function () {

    // Session Management
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    // Email Verification Flow
    Route::prefix('email')->group(function () {
        Route::get('/verify', function () {
            return view('pages.auth.verify-email');
        })->name('verification.notice');

        Route::get('/verify/{id}/{hash}', VerifyEmailController::class)
            ->middleware(['signed', 'throttle:6,1'])
            ->name('verification.verify');

        Route::post('/verification-notification',[EmailVerificationNotificationController::class,'store'])->middleware('throttle:6,1')->name('verification.send');
    });
});
