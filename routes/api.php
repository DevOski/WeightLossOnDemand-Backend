<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;

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
Route::post('signup', [UserController::class,'signup']);
Route::post('forgot_pass', [UserController::class,'forgot_pass']);
Route::get('user_details', [UserController::class,'user_details']);
Route::post('update_username', [UserController::class,'update_username']);
Route::post('update_email', [UserController::class,'update_email']);
Route::post('update_phone', [UserController::class,'update_phone']);
Route::post('update_address', [UserController::class,'update_address']);
Route::post('update_password', [UserController::class,'update_password']);
Route::post('update_fingrprnt', [UserController::class,'update_fingrprnt']);
Route::post('update_med_rec', [UserController::class,'update_med_rec']);
Route::post('update_health_rec', [UserController::class,'update_health_rec']);