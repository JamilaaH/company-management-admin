<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EntrepriseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware(['auth:sanctum']);

//dashboard avec notif 
Route::get('/dashboard', [EntrepriseController::class, 'dashboard'])->middleware(['auth:sanctum']);
Route::get('/entreprise', [EntrepriseController::class, 'index'])->middleware(['auth:sanctum']);
Route::post('/entreprise/store', [EntrepriseController::class, 'register'])->middleware(['auth:sanctum']);
Route::put('/entreprise/update', [EntrepriseController::class, 'update'])->middleware(['auth:sanctum']);

Route::get('/task', [EntrepriseController::class, 'task'])->middleware(['auth:sanctum']);
Route::put('/task/{id}', [EntrepriseController::class, 'done'])->middleware(['auth:sanctum']);

Route::get('/messages', [EntrepriseController::class, 'messages'])->middleware(['auth:sanctum']);
Route::post('/messages/store', [EntrepriseController::class, 'envoiMessage'])->middleware(['auth:sanctum']);
