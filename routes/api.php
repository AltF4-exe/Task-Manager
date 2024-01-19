<?php

use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// get tasks list
Route::get('/tasks', [TaskController::class, 'index']);
// retrieve a single task
Route::get('/tasks/{task}', [TaskController::class, 'show']);
// create a task
Route::post('/tasks', [TaskController::class, 'store']);
// update a task
Route::put('/tasks/{task}', [TaskController::class, 'update']);
// delete a task
Route::delete('/tasks/{task}', [TaskController::class, 'destroy']);
// mark a task as completed
Route::put('/tasks/{task}/complete', [TaskController::class, 'complete']);
// get all completed tasks
Route::get('/completed', [TaskController::class, 'completedTasks']);
// get all past due tasks
Route::get('/past-due', [TaskController::class, 'pastDueTasks']);
