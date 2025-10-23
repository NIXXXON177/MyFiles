<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

// Главная страница
Route::get('/', [PageController::class, 'welcome'])->name('home');

// Маршруты аутентификации
Route::middleware('guest')->group(function () {
    // Страница регистрации
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    // Страница входа
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Защищенные маршруты (только для авторизованных пользователей)
Route::middleware('auth')->group(function () {
    // Личный кабинет
    Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');

    // Выход
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Дополнительные страницы
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/services', [PageController::class, 'services'])->name('services');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
