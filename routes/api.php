<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AdvisoryController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\SupervisionController;  
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\LectureController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

  
Route::post('/login', [AuthController::class, 'login']);  
Route::post('/register', [AuthController::class, 'register']);  


Route::middleware(['auth:sanctum'])->group(function () {  
    Route::apiResource('projects', ProjectController::class);  
    Route::post('/projects/{id}', [ProjectController::class, 'show']);  
    Route::get('/projects/lectures', [ProjectController::class, 'listSupervisors']);
    Route::get('/user', [AuthController::class, 'getUser']);  
    Route::PUT('/user', [AuthController::class, 'updateUser']);  
    Route::delete('/logout', [AuthController::class, 'logout']);
    Route::get('/project/supervisions', [SupervisionController::class, 'index']);  
    Route::get('/project/supervisions/{id}/log', [SupervisionController::class, 'show']);  
    Route::post('/project/supervisions/{id}/log', [SupervisionController::class, 'addLog']);  
    Route::post('/project/proposals/{id}/review', [SupervisionController::class, 'approveProposal']);  
    Route::post('/project/proposals/{id}/approve', [SupervisionController::class, 'readyForDefense']);
    Route::apiResource('/advisories', AdvisoryController::class);
    Route::post('/advisories/{id}/response', [AdvisoryController::class, 'respond']);
    Route::get('/', [LectureController::class, 'index']); 
    Route::get('lecture/{id}/activities', [LectureController::class, 'activities']);
    Route::post('lecture/{id}/post', [LectureController::class, 'storeActivity']);
    Route::post('lecture/{id}/review', [LectureController::class, 'review']); 
    Route::post('lecture/{id}/approved', [LectureController::class, 'approve']);
    Route::get('/lectures', [LectureController::class, 'index']);            
});  