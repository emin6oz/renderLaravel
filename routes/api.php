<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\IkeaController;

Route::post('/register', [UserAuthController::class, 'register']);
// Route::middleware('web')->group(function () {
//     Route::post('/register', [UserAuthController::class, 'register']);
// });

Route::post('/login', [UserAuthController::class, 'login']);

Route::get('/ikea/search', [IkeaController::class, 'search']);


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [UserAuthController::class, 'logout']);

    // User profile
    Route::get('/profile', [UserController::class, 'show']);
    Route::put('/profile', [UserController::class, 'update']);
    Route::delete('/profile', [UserController::class, 'destroy']);
});

