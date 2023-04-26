<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeControllers\HomeMessageController;
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

Route::post('/send-email/client', [HomeMessageController::class, 'sedEmailClient']);


