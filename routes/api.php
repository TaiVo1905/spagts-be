<?php
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\UserImportController;
use App\Http\Controllers\Api\V1\ClassController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\SelfStudyPlanController;
use App\Http\Controllers\Api\V1\InClassController;
use App\Http\Controllers\Api\V1\WeekGoalController;
use App\Http\Controllers\Api\V1\ModuleController;





Route::post('/v1/login', [AuthController::class, 'login'])->name('login');
Route::group(['prefix' => 'v1', 'middleware' => 'auth:sanctum'], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/users/import', [UserImportController::class, 'import']);
    Route::get('/users/template', [UserImportController::class, 'downloadTemplate']);
    Route::apiResource('users', UserController::class);
    Route::apiResource('classes', ClassController::class);
    Route::apiResource('self-study-plans', SelfStudyPlanController::class);
    Route::patch('self-study-plans/{id}', [SelfStudyPlanController::class, 'update']);
    Route::post('selfstudy-plans', [SelfStudyPlanController::class, 'store']);
    Route::get('self-study-plans/{id}', [SelfStudyPlanController::class, 'show']);
    Route::apiResource('inclass-plan', InClassController::class);
    Route::apiResource('modules', ModuleController::class);
    Route::apiResource('weekly-goals', WeekGoalController::class);
    Route::get('weekly-goals', [WeekGoalController::class, 'getAll']);

    





});


