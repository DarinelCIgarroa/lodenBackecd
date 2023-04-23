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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('message', MessageController::class);
Route::resource('company', CompanyController::class);
Route::resource('events',EventController::class);

Route::get('email', function(){

    $details['email'] = 'Emmanuelarcos.97@gmail.com';

    dispatch(new App\Jobs\SendEmailJob($details));

    dd('done');
});

