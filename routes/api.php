<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CertificateController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\UserImportController;
use App\Http\Controllers\Api\ClassController;
use App\Http\Controllers\Api\SemesterGoalController;
use App\Http\Controllers\Api\ModuleController;
use App\Http\Controllers\Api\SelfStudyPlanController;
use App\Http\Controllers\Api\InClassController;
use App\Http\Controllers\Api\WeeklyGoalController;
use App\Http\Controllers\Api\TimetableController;
use App\Http\Controllers\Api\ForgotPasswordController;
use Illuminate\Support\Facades\Route;

Route::post('/v1/login', [AuthController::class, 'login'])->name('login');
Route::apiResource('users', UserController::class);

Route::prefix('v1')->group(function () {
    Route::post('/forgot-password/send-code', [ForgotPasswordController::class, 'sendResetCode']);
    Route::post('/forgot-password/verify-code', [ForgotPasswordController::class, 'verifyCode']);
    Route::post('/forgot-password/reset-password', [ForgotPasswordController::class, 'resetPassword']);
});

Route::group(['prefix' => 'v1', 'middleware' => 'auth:sanctum'], function () {
    // Auth
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/users/import', [UserImportController::class, 'import']);
    Route::get('/users/template', [UserImportController::class, 'downloadTemplate']);

    // Student
    Route::apiResource('classes', ClassController::class);
    Route::apiResource('semesterGoals', SemesterGoalController::class);
    Route::apiResource('achievements', CertificateController::class);
    Route::apiResource('modules', ModuleController::class);
    Route::apiResource('timetables', TimetableController::class);
    Route::apiResource('self-study-plans', SelfStudyPlanController::class);
    Route::apiResource('in-class-plan', InClassController::class);
    Route::apiResource('weekly-goals', WeeklyGoalController::class);
});
