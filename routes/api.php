<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\CertificateController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\UserImportController;
use App\Http\Controllers\Api\V1\ClassController;
use App\Http\Controllers\Api\V1\GoalController;
use App\Http\Controllers\Api\V1\ModuleController;
use Illuminate\Support\Facades\Route;
use PhpParser\Builder\Class_;
use App\Http\Controllers\Api\V1\SelfStudyPlanController;
use App\Http\Controllers\Api\V1\InClassController;
use App\Http\Controllers\Api\V1\WeekGoalController;





Route::post('/v1/login', [AuthController::class, 'login'])->name('login');
Route::group(['prefix' => 'v1', 'middleware' => 'auth:sanctum'], function () {
    Route::apiResource('users', UserController::class);
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/users/import', [UserImportController::class, 'import']);
    Route::get('/users/template', [UserImportController::class, 'downloadTemplate']);
    Route::apiResource('classes', ClassController::class);
    Route::apiResource('goals', GoalController::class);
    Route::apiResource('modules', ModuleController::class);
    Route::apiResource('/timetables', \App\Http\Controllers\Api\V1\TimetableController::class);
    Route::apiResource('/achievements', CertificateController::class);
    Route::apiResource('self-study-plans', SelfStudyPlanController::class);
    Route::patch('self-study-plans/{id}', [SelfStudyPlanController::class, 'update']);
    Route::post('selfstudy-plans', [SelfStudyPlanController::class, 'store']);
    Route::get('self-study-plans/{id}', [SelfStudyPlanController::class, 'show']);
    Route::apiResource('inclass-plan', InClassController::class);
    Route::apiResource('modules', ModuleController::class);
    Route::apiResource('weekly-goals', WeekGoalController::class);
    Route::get('weekly-goals', [WeekGoalController::class, 'getAll']);

    





});


