<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Middleware\setlocale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('{locale?}')
    ->where(['locale' => implode('|', config('app.available_locales'))])
    ->middleware('setLocale')
    ->group(function () {

        Route::middleware(['auth','verified'])->group(function () {
            Route::view('/', 'pages.starter')->name('dashboard');
        });


        // Auth + Email Verification
        require __DIR__ . '/auth.php';
    });

