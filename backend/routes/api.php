<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\GiangVienController;
use App\Http\Controllers\admin\SinhVienController;
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

    Route::get('/sinhvien', [SinhVienController::class, 'index']);
    Route::post('/sinhvien', [SinhVienController::class, 'store']);
    Route::post('/sinhviens', [SinhVienController::class, 'storeMany']);
    Route::get('/sinhvien/{id}', [SinhVienController::class, 'show']);
    Route::put('/sinhvien/{id}', [SinhVienController::class, 'update']);
    Route::delete('/sinhvien/{id}', [SinhVienController::class, 'destroy']);

    Route::get('/giangvien', [GiangVienController::class, 'index']);
    Route::post('/giangvien', [GiangVienController::class, 'store']);
    Route::post('/giangviens', [GiangVienController::class, 'storeMany']);
    Route::get('/giangvien/{id}', [GiangVienController::class, 'show']);
    Route::put('/giangvien/{id}', [GiangVienController::class, 'update']);
    Route::delete('/giangvien/{id}', [GiangVienController::class, 'destroy']);

    
});