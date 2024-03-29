<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ArticlesController;
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

// Protect the articles routes
//Route::middleware('auth:sanctum')->group(function () {
//    Route::get('/articles', [ArticlesController::class, 'index']);
//    // You can add more protected routes here
//});

Route::get('/articles', [ArticlesController::class, 'index']);
