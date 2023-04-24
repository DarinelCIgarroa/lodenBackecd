<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminControllers\CompanyController;
use App\Http\Controllers\AdminControllers\MessageController;

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
