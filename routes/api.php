<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth.jwt')->group(function () {
    Route::prefix('users')->group(function () {
        Route::resource('user', UserController::class);
    });
});

Route::prefix('auth')->group(function () {
    Route::post('login',        [AuthController::class, 'login']);
    Route::middleware('auth.jwt')->group(function () {
        Route::post('logout',   [AuthController::class, 'logout']);
        Route::post('refresh',  [AuthController::class, 'refresh']);
        Route::post('me',       [AuthController::class, 'me']);
    });
});
