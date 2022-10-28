<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\TrainerController;
use App\Http\Controllers\API\VisitController;
use App\Http\Controllers\API\ChatController;
use App\Http\Controllers\API\AppointmentController;

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
Route::post('signin', [UserController::class,'signin']);
Route::post('forgot_pass', [UserController::class,'forgot_pass']);
Route::post('check_code', [UserController::class,'check_code']);
Route::get('user_details', [UserController::class,'user_details']);
Route::post('update_username', [UserController::class,'update_username']);
Route::post('update_email', [UserController::class,'update_email']);
Route::post('update_phone', [UserController::class,'update_phone']);
Route::post('update_address', [UserController::class,'update_address']);
Route::post('update_password', [UserController::class,'update_password']);
Route::post('update_fingrprnt', [UserController::class,'update_fingrprnt']);
Route::post('update_med_rec', [UserController::class,'update_med_rec']);
Route::post('update_health_rec', [UserController::class,'update_health_rec']);
Route::get('trainertype', [TrainerController::class,'trainertype']);
Route::get('trainersList/{type}', [TrainerController::class,'trainersList']);
Route::get('trainerDesc/{id}', [TrainerController::class,'trainerDesc']);
Route::get('trainers', [TrainerController::class,'trainers']);
Route::get('Slots', [TrainerController::class,'Slots']);
Route::post('trTimeSlots/{id}', [TrainerController::class,'trTimeSlots']);
Route::post('trCalenderSlots', [TrainerController::class,'trCalenderSlots']);
Route::get('receipt', [VisitController::class,'receipt']);
Route::get('questionary', [VisitController::class,'questionary']);
Route::post('question', [VisitController::class,'question']);
Route::post('create_visit', [VisitController::class,'create_visit']);
Route::post('tr_rating', [TrainerController::class,'tr_rating']);
Route::get('visit_reason', [VisitController::class,'visit_reason']);
Route::post('search_reason', [VisitController::class,'search_reason']);
Route::get('past_visit', [VisitController::class,'past_visit']);
Route::post('app_rating', [TrainerController::class,'app_rating']);
Route::get('all_trCalenderSlots', [TrainerController::class,'all_trCalenderSlots']);
Route::post('coupon_check', [UserController::class,'coupon_check']);
Route::get('chat_display', [ChatController::class,'chat_display']);
Route::post('msg_sent', [ChatController::class,'msg_sent']);
Route::post('appointment', [AppointmentController::class,'appointment']);

