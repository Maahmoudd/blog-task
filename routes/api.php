<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\PostController;
use Illuminate\Support\Facades\Route;



Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'login')->name('login');
    Route::post('/register', 'register')->name('register');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('/posts', PostController::class);
    Route::prefix('/posts/{post}/comments')->controller(CommentController::class)->group(function () {
        Route::post('/', 'store')->name('comments.store');
        Route::delete('/{comment}', 'destroy')->name('comments.destroy');
    });
});



