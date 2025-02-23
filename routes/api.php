<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarsController;
use App\Http\Controllers\RideController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::prefix('auth')->middleware('api')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
});

Route::prefix('users')->middleware(['auth:sanctum','api'])->group( function () {
    Route::get('/', [UserController::class, 'index']);
    Route::post('/', [UserController::class, 'store']);
    Route::get('/{id}', [UserController::class, 'show']);
    Route::put('/{id}', [UserController::class, 'update']);
    Route::delete('/{id}', [UserController::class, 'destroy']);
});

Route::prefix('rides')->middleware(['auth:sanctum', 'api'])->group(function () {
    Route::post('/rides',[RideController::class, 'createRide'])->name('rides.store');
    Route::get('/rides',[RideController::class, 'getRides'])->name('rides.index');
    Route::get('/rides/{id}',[RideController::class, 'getRide']);
    Route::put('/rides/{id}',[RideController::class, 'updateRide']);
    Route::delete('/rides/{id}',[RideController::class, 'deleteRide']);

});

Route::prefix('cars')->middleware(['auth:sanctum', 'api'])->group(function (){
    Route::get('/', [CarsController::class, 'index']);
    Route::post('/', [CarsController::class, 'store']);
    Route::get('/{id}', [CarsController::class, 'show']);
    Route::put('/{id}', [CarsController::class, 'update']);
    Route::delete('/{id}', [CarsController::class, 'destroy']);
});