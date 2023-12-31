<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;

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


Route::middleware('auth:sanctum')->group(function () {
    //user
    Route::get('user', [UserController::class, 'index']);
    Route::put('update', [UserController::class, 'updateProfile']);
    Route::delete('delete', [UserController::class, 'destroyAccount']);

    //tarefas
    Route::post('createtask', [TaskController::class, 'store']);
    Route::get('alltasks', [TaskController::class, 'index']);
    Route::get('task/{id}',[TaskController::class, 'task']);
});

    


//cadastro e login
Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);








