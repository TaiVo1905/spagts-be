<?php
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\ClassController;


Route::prefix('v1')->group(function () {
    Route::apiResource('users', UserController::class);
});

Route::prefix('v1')->group(function () {
    Route::apiResource('class-names', ClassController::class);
});
