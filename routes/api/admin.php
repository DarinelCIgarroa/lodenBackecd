<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\MessageController;

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

Route::middleware('auth:sanctum')->group(function () {

    // Route::resource('message', MessageController::class);
    Route::group(['prefix' => 'message'], function () {
        Route::resource('', MessageController::class)->parameters([
            '' => 'message'
        ]);
    });

    Route::group(['prefix' => 'company'], function () {
        Route::resource('', CompanyController::class)->parameters([
            '' => 'company'
        ]);
    });
});
