<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Auth\Http\Controllers\LoginController;
use Modules\Auth\Http\Controllers\RegisterController;
use Modules\Auth\Http\Controllers\VerificationController;

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

Route::group(['namespace' => 'Auth', 'prefix' => 'v1/auth'], function () {
    Route::post('login', [LoginController::class, 'index']);
    Route::post('register', [RegisterController::class, 'index']);
    Route::post('verification', [VerificationController::class, 'send'])->middleware('verification.throttle');
    Route::get('verification', [VerificationController::class, 'verify']);
});
