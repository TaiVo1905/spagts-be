<?php

use App\Http\Controllers\Api\V1\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::apiResource('users', UserController::class);
    
});

Route::patch('v1/users/{user}/password', [UserController::class, 'updatePassword'])->name('users.updatePassword');;

