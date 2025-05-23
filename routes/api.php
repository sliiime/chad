<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;

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

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) { */
/*     return $request->user(); */
/* }); */

/* User */

Route::post('/user',     [UserController::class, 'store']);

Route::middleware('chad:api')->group(function(){
    Route::get('/user',      [UserController::class, 'index']);
    Route::get('/user/{id}', [UserController::class, 'show']);
    Route::put('/user/{id}', [UserController::class, 'update']);

    Route::apiResource('/post', PostController::class);
    Route::post('/post/{id}/reaction', [PostController::class, 'reaction']);

    Route::apiResource('/reaction', ReactionController::class);
});

/*Login*/
Route::post('/login', [LoginController::class, 'login']);
