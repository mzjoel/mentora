<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AdvisoryController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\SupervisionController;  

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

  
Route::post('/login', [AuthController::class, 'login']);  
Route::post('/register', [AuthController::class, 'register']);  
Route::apiResource('/users', UserController::class);


Route::middleware(['auth:sanctum'])->group(function () {  
    Route::apiResource('projects', ProjectProposalController::class);  
    Route::post('/projects/{id}/upload', [ProjectProposalController::class, 'uploadDraft']);  
    Route::get('/projects/lectures', [ProjectProposalController::class, 'listSupervisors']);
    Route::get('/user', [AuthController::class, 'getUser']);  
    Route::post('/user', [AuthController::class, 'updateUser']);  
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/project/supervisions', [SupervisionController::class, 'index']);  
    Route::get('/project/supervisions/{id}/log', [SupervisionController::class, 'show']);  
    Route::post('/project/supervisions/{id}/log', [SupervisionController::class, 'addLog']);  
    Route::post('/project/proposals/{id}/review', [SupervisionController::class, 'approveProposal']);  
    Route::post('/project/proposals/{id}/approve', [SupervisionController::class, 'readyForDefense']);
    Route::apiResource('/advisories', AdvisoryController::class);
    Route::post('/advisories/{id}/response', [AdvisoryController::class, 'respond']);         
});  