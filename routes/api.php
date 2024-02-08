<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UsersController;
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

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::post('/user', [AuthController::class, 'user']);


Route::prefix('users')->group(function () {
    Route::get('/', [UsersController::class, 'index']);
    Route::get('/{id}',[UsersController::class, 'show']);
    Route::post('/', [UsersController::class, 'create']);
    Route::delete('/{id}', [UsersController::class, 'destroy']);
});

Route::prefix('posts')->group(function () {
    Route::get('/', [PostController::class, 'index']);
    Route::get('/{id}',[PostController::class, 'show']);
    Route::post('/', [PostController::class, 'create']);
    Route::delete('/{id}', [PostController::class, 'destroy']);
    Route::put('/{id}', [PostController::class, 'update']);
});

Route::prefix('categories')->group(function () {
    Route::get('/', [CategoriasController::class, 'index']);
    Route::get('/{id}', [CategoriasController::class, 'show']);
    Route::post('/', [CategoriasController::class, 'create']);
    Route::delete('/{id}', [CategoriasController::class, 'destroy']);
    Route::put('/{id}', [CategoriasController::class, 'update']);
});
