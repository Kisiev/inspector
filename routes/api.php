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
    Route::post('login', [LoginController::class, 'index'])->name('login');
    Route::post('register', [RegisterController::class, 'index'])->name('register');
    Route::post('verification', [VerificationController::class, 'send'])->middleware('verification.throttle')->name('verification.send');
    Route::get('verification', [VerificationController::class, 'verify'])->name('verification.verify');
});
