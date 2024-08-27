<?php

use App\Http\Controllers\api\AccessTokenController;
use App\Http\Controllers\api\CommentController;
use App\Http\Controllers\api\PostController;
use App\Http\Controllers\api\SanctumController;
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

Route::apiResource('posts', PostController::class);
Route::apiResource('comments', CommentController::class);

Route::post('register',[SanctumController::class,'register']);
Route::post('login',[SanctumController::class,'login']);
Route::post('logout',[SanctumController::class,'logout'])->middleware('auth:sanctum');


