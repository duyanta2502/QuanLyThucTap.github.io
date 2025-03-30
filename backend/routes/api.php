<?php

use App\Http\Controllers\Auth\AuthenticateController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\admin\DashboardController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
Route::apiResource('register', RegisterController::class);
Route::apiResource( 'login', AuthenticateController::class);

Route::get('count-user', [DashboardController::class, 'countUser']);