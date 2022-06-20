<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Auth\Http\Controllers\LoginController;
use Modules\Auth\Http\Controllers\RegisterController;
use Modules\Auth\Http\Controllers\VerificationController;
use Modules\Rate\Http\Controllers\CityController;
use Modules\Rate\Http\Controllers\ShopController;
use Modules\Telegram\Http\Controllers\TelegramController;

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

Route::group(['namespace' => 'Rate', 'prefix' => 'v1'], function () {
    Route::get('city', [CityController::class, 'index']);
    Route::get('shop', [ShopController::class, 'index']);
    Route::post('review', [ShopController::class, 'addReview'])->middleware('auth:sanctum');
    Route::put('review', [ShopController::class, 'updateReview'])->middleware('auth:sanctum');
});

Route::group(['prefix' => 'telegram'], function () {
    Route::post('webhook', [TelegramController::class, 'index'])->name('telegram.webhook');
});