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
use \App\Http\Controllers\Api\ActivityLogController;





Route::post('/v1/login', [AuthController::class, 'login'])->name('login');

Route::group(['prefix' => 'v1', 'middleware' => 'auth:sanctum'], function () {
    Route::apiResource('users', UserController::class);
    //auth
    Route::get('/user', [AuthController::class, 'user']);
    Route::get('users/{id}/classes', [UserController::class, 'getUserClasses']);
    Route::get('modules/{moduleId}/users', [ModuleController::class, 'getModuleUsers']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/users/import', [UserImportController::class, 'import']);
    Route::get('/users/import/template', [UserImportController::class, 'downloadTemplate']);

    //student
    Route::apiResource('classes', ClassController::class);
    Route::get('classes/{id}/users', [ClassController::class, 'getClassMembers']);
    Route::put('classes/{id}/users', [ClassController::class, 'updateClassMembers']);
    Route::delete('classes/{id}/users', [ClassController::class, 'deleteClassUsers']);
    Route::delete('classes/{id}/modules', [ClassController::class, 'deleteClassModules']);
    Route::apiResource('semesterGoals', SemesterGoalController::class);
    Route::apiResource('users.semesterGoals', SemesterGoalController::class);
    Route::apiResource('achievements', CertificateController::class);
    Route::apiResource('modules', ModuleController::class);
    Route::get('userModules', [ModuleController::class, 'getUserModules']);

    // Add the route for linking modules to classes here
    Route::post('modules/{moduleId}/classes', [ModuleController::class, 'addClassesToModule']);
    Route::get('modules/{moduleId}/classes', [ModuleController::class, 'getClassesFromModule']);

    Route::apiResource('timetables', TimetableController::class);
    Route::apiResource('self-study-plans', SelfStudyPlanController::class);
    Route::apiResource('in-class-plan', InClassController::class);
    Route::apiResource('weekly-goals', WeeklyGoalController::class);
    Route::apiResource('activityLog', ActivityLogController::class);
});


