<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TweetController;
use App\Http\Controllers\Api\UserController;
use App\Http\Middleware\SetLocale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['middleware' => SetLocale::class], function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);

    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::get('logout', [AuthController::class, 'logout']);

        Route::post('/tweets', [TweetController::class, 'store']);
        Route::get('/timeline', [TweetController::class, 'timeline']);

        Route::post('/users/{user}/follow', [UserController::class, 'follow']);
        Route::post('/users/{user}/unfollow', [UserController::class, 'unfollow']);

    });

});
