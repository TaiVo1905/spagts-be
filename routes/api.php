<?php
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\UserImportController;
use App\Http\Controllers\Api\V1\ClassController;
use Illuminate\Support\Facades\Route;

Route::post('/v1/login', [AuthController::class, 'login'])->name('login');
Route::group(['prefix' => 'v1', 'middleware' => 'auth:sanctum'], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/users/import', [UserImportController::class, 'import']);
    Route::get('/users/template', [UserImportController::class, 'downloadTemplate']);
    Route::apiResource('users', UserController::class);
    Route::apiResource('classes', ClassController::class);
});
