<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\Auth\AuthenticateController;
use Illuminate\Auth\Middleware\Authenticate;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
Route::apiResource('register', RegisterController::class);
Route::apiResource( 'login', AuthenticateController::class);

Route::get('count-user', [DashboardController::class, 'countUser'])->middleware('auth:sanctum');
Route::get('user/name', [DashboardController::class,'getNameUser'])->middleware('auth:sanctum');
Route::get('logout', [AuthenticateController::class, 'logout'])->middleware('auth:sanctum');
