<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'login');
    Route::post('/register', 'register');
    Route::middleware('auth:api')->post('/logout', 'logout');
});

Route::controller(UserController::class)->group(function () {
    Route::middleware('auth:api')->get('/users', 'index');
    Route::middleware('auth:api')->get('/users/{id}', 'show');
    Route::post('/users', 'store');
    Route::middleware('auth:api')->put('/users/{id}', 'update');
    Route::middleware('auth:api')->delete('/users/{id}', 'destroy');
});

Route::controller(EventController::class)->group(function () {
    Route::middleware('auth:api')->get('/events', 'index');
    Route::middleware('auth:api')->get('/events/{event:id}', 'show');
    Route::middleware('auth:api')->post('/events', 'store');
    Route::middleware('auth:api')->put('/events/{event:id}', 'update');
    Route::middleware('auth:api')->delete('/events/{event:id}', 'destroy');
});
