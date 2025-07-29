<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RestaurantController;

Route::post('/auth', [AuthController::class, 'index'])->middleware('throttle:5,1');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('restaurants', [RestaurantController::class, 'index']);
    Route::post('restaurants', [RestaurantController::class, 'store']);
    Route::put('restaurants/{id}', [RestaurantController::class, 'update']);
    Route::patch('restaurants/{id}', [RestaurantController::class, 'update']);
    Route::delete('restaurants/{id}', [RestaurantController::class, 'destroy']);
});