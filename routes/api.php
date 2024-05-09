<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TodoController;

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout')->middleware('auth:api');
    Route::post('refresh', 'refresh')->middleware('auth:api');

});


Route::controller(TodoController::class)->group(function () {
    Route::get('todo', 'index');
    Route::post('todo', 'store');
    Route::get('todo/{id}', 'show');
    Route::put('todo/{id}', 'update');
    Route::delete('todo/{id}', 'destroy');

})->middleware('auth:api');;


Route::controller(TaskController::class)->group(function () {
    Route::get('task/{todoId}', 'index');
    Route::post('task/{todoId}', 'store');
    Route::get('task/{todoId}/{id}', 'show');
    Route::put('task/{todoId}/{id}', 'update');
    Route::delete('task/{todoId}/{id}', 'destroy');

})->middleware('auth:api');
