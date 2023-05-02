<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminControllers\TeamController;
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
        Route::controller(MessageController::class)->group(function () {
            Route::post('/index', 'index');
            Route::patch('/{message}', 'update');
            Route::post('', 'store');
            Route::delete('/{message}', 'destroy');
        });
    });

    Route::group(['prefix' => 'company'], function () {
        Route::resource('', CompanyController::class)->parameters([
            '' => 'company'
        ]);
    });

    Route::group(['prefix' => 'team'], function () {
        Route::controller(TeamController::class)->group(function () {
            Route::post('/index', 'index');
            Route::patch('/{team}', 'update');
            Route::post('', 'store');
            Route::delete('/{team}', 'destroy');
        });
    });

});
