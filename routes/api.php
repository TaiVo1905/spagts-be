<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CertificateController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\UserImportController;
use App\Http\Controllers\Api\ClassController;
use App\Http\Controllers\Api\SemesterGoalController;
use App\Http\Controllers\Api\ModuleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SelfStudyPlanController;
use App\Http\Controllers\Api\InClassController;
use App\Http\Controllers\Api\WeeklyGoalController;
use \App\Http\Controllers\Api\TimetableController;
// use PhpParser\Builder\Class_;





Route::post('/v1/login', [AuthController::class, 'login'])->name('login');

Route::apiResource('users', UserController::class);
Route::group(['prefix' => 'v1', 'middleware' => 'auth:sanctum'], function () {
    //auth
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/users/import', [UserImportController::class, 'import']);
    Route::get('/users/template', [UserImportController::class, 'downloadTemplate']);

    //student
    Route::apiResource('classes', ClassController::class);
    Route::apiResource('semesterGoals', SemesterGoalController::class);
    Route::apiResource('achievements', CertificateController::class);
    Route::apiResource('modules', ModuleController::class);
    Route::apiResource('timetables', TimetableController::class);
    Route::apiResource('self-study-plans', SelfStudyPlanController::class);
    Route::apiResource('in-class-plan', InClassController::class);
    Route::apiResource('weekly-goals', WeeklyGoalController::class);
});


