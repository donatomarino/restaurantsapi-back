<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RestaurantController;

Route::post('/auth', [AuthController::class, 'index']);

Route::apiResource('restaurants', RestaurantController::class)->middleware('auth:sanctum');