<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
 */

 // Route Group Auth
Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/me', [AuthController::class, 'me'])->middleware('auth:sanctum');
});

//Route Group Middleware Auth Sanctum
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/create-order', function () {
        return 'create order';
    })->middleware(['ableCreateOrder']);
    
    Route::post('/finish-order', function () {
        return 'finish order';
    })->middleware(['ableFinishOrder']);

    Route::post('/user', [UserController::class, 'store'])->middleware(['ableCreateUser']);

    Route::post('/item', [ItemController::class, 'store'])->middleware(['ableCreateUpdateItem']);
    Route::patch('/item/{id}', [ItemController::class, 'update'])->middleware(['ableCreateUpdateItem']);
});


