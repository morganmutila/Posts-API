<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::apiResource('users', UserController::class);


//Public routes
Route::post('auth/login', LoginController::class)->name('login');
Route::post('auth/register', RegisterController::class)->name('register');
Route::apiResource('posts', PostController::class)->only('index', 'show');

// Protected routes
Route::middleware('auth:sanctum')->group(function(){
    Route::apiResource('posts', PostController::class)->only('store', 'update', 'destroy');
    Route::post("auth/logout", LogoutController::class)->name("logout");
});




