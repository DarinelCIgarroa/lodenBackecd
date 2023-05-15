<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeControllers\HomeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(AuthController::class)->group(function () {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/logout/{id}', [AuthController::class, 'logout']);
});

Route::group(['prefix' => 'message'], function () {
    Route::controller(HomeMessageController::class)->group(function () {
        Route::post('/send-email/client', 'sedEmailClient');
    });
});

Route::group(['prefix' => 'home'], function () {
    Route::controller(HomeController::class)->group(function () {
        Route::get('/company', 'getHomeCompany');
        Route::get('/get-events', 'getHomeAllEvents');
        Route::get('/get-events-online', 'getHomeOnlineEvents');
        Route::get('/get-events-in-person', 'getHomeInPersonEvents');
        Route::get('/get-members', 'getHomeMembers');
    });
});
