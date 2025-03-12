<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', \App\Http\Controllers\Api\Auth\RegisterController::class);

//http://127.0.0.1:8000/api/login
Route::post('login', \App\Http\Controllers\Api\Auth\LoginController::class);

Route::apiResource('todos', \App\Http\Controllers\Api\TodoController::class)->middleware('auth:sanctum');
