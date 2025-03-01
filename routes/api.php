<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CarModelController;
use App\Http\Controllers\CarsController;
use App\Http\Controllers\LocationsController;
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
    Route::post('/',[RideController::class, 'createRide'])->name('rides.store');
    Route::get('/',[RideController::class, 'getRides'])->name('rides.index');
    Route::get('/{id}',[RideController::class, 'getRide']);
    Route::put('/{id}',[RideController::class, 'updateRide']);
    Route::delete('/{id}',[RideController::class, 'deleteRide']);

});

Route::prefix('cars')->middleware(['auth:sanctum', 'api'])->group(function (){
    Route::get('/', [CarsController::class, 'index']);
    Route::post('/', [CarsController::class, 'store']);
    Route::get('/{id}', [CarsController::class, 'show']);
    Route::put('/{id}', [CarsController::class, 'update']);
    Route::delete('/{id}', [CarsController::class, 'destroy']);
});

Route::prefix('bookings')->middleware(['auth:sanctum', 'api'])->group(function (){
    Route::get('/', [BookingController::class, 'index']);
    Route::post('/', [BookingController::class, 'store']);
    Route::get('/{id}', [BookingController::class, 'show']);
    Route::put('/{id}', [BookingController::class, 'update']);
    Route::delete('/{id}', [BookingController::class, 'destroy']);
});

Route::prefix('location')->middleware(['auth:sanctum', 'api'])->group(function (){
    Route::get('/', [LocationsController::class, 'index']);
    Route::post('/', [LocationsController::class, 'store']);
    Route::get('/{id}', [LocationsController::class, 'show']);
    Route::put('/{id}', [LocationsController::class, 'update']);
    Route::delete('/{id}', [LocationsController::class, 'destroy']);
});

Route::prefix('model')->middleware(['auth:sanctum', 'api'])->group(function (){
    Route::get('/', [CarModelController::class, 'index']);
    Route::post('/', [CarModelController::class, 'store']);
    Route::get('/{id}', [CarModelController::class, 'show']);
    Route::put('/{id}', [CarModelController::class, 'update']);
    Route::delete('/{id}', [CarModelController::class, 'destroy']);
});