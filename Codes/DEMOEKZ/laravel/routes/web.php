<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Models\Cargo;
use App\Models\Order;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

Route::get('/', function () {
    $cargos = Cargo::all();
    return view('welcome', compact('cargos'));
});

Route::middleware('admin')->group(function () {
    Route::get('/admin', function () {
       $orders = Order::all();
       return view('admin', compact('orders'));
    });

    Route::post('/admin/accepted/{id}', [AdminController::class, 'accepted']);
    Route::post('/admin/declined/{id}', [AdminController::class, 'declined']);
});

Route::get('/login', function () {
    return view('login');
});

Route::post('/', [AuthController::class, 'register']);
Route::post('/', [OrderController::class, 'set'])->name('order.set');

Route::get('/logout', [AuthController::class, 'logout']);
