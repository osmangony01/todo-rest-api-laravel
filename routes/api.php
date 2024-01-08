<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

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
// get api for fetching all todo
Route::get('/todos', [TodoController::class, 'index']);

// get api for fetching single todo
Route::get('/todos/{id}',  [TodoController::class, 'singleTodo']);

// post api for inserting todo
Route::post('/add-todo', [TodoController::class, 'addTodo']);

// put api for updating todo
Route::put('/update-todo/{id}', [TodoController::class, 'updateTodo']);

