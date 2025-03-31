<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\AuthenticateController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\AdminController;


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
Route::apiResource('register', RegisterController::class);
Route::apiResource( 'login', AuthenticateController::class);
Route::apiResource( 'forgot-password', ForgotPasswordController::class);
Route::apiResource( 'reset-password', ResetPasswordController::class);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('count-user', [DashboardController::class, 'countUser']);
    Route::get('logout', [AuthenticateController::class, 'logout']);
    Route::get('get-account-info', [AdminController::class, 'getAccoutInfo']);
    Route::post('edit-profile', [AdminController::class, 'editProfile']);


});