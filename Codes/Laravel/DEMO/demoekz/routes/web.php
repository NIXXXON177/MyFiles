<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\AuthController;

Route::get('/{locale?}', function ($locale = 'en') {
    App::setLocale($locale);
    return view('welcome');
})->where('locale', 'en|ru')->name('home');

Route::prefix('{locale}')->where(['locale' => 'en|ru'])->group(function () {

    Route::get('/about', function ($locale) {
        App::setLocale($locale);
        return view('about');
    })->name('about');

    Route::get('/contact', function ($locale) {
        App::setLocale($locale);
        return view('contact');
    })->name('contact');

    Route::middleware('guest')->group(function () {
        Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
        Route::post('/register', [AuthController::class, 'register']);
        Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AuthController::class, 'login']);
    });

    // Защищенные маршруты
    Route::middleware('auth')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    });
});
