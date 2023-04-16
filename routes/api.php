<?php

use App\Http\Controllers\API\APIGenderController;
use App\Http\Controllers\API\APIGetAdController;
use App\Http\Controllers\API\APISearchAdController;
use App\Http\Controllers\API\APIUserController;
use App\Http\Controllers\API\AuthController;
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

Route::post('OTPSendCode',[AuthController::class,'OTPSendCode']);
Route::post('OTPVerifyCode',[AuthController::class,'OTPVerifyCode']);
Route::post('/login/email',[AuthController::class,'emailLogin']);
Route::post('/register/email',[AuthController::class,'emailRegister']);

Route::get('/genders',[APIGenderController::class,'index']);


Route::middleware('auth.optional')->group(function (){
    Route::get('/ad',[APISearchAdController::class,'index']);
    Route::get('/ad/{ad}',[APISearchAdController::class,'show']);
    Route::get('/ad_get',[APIGetAdController::class,'index']);
    Route::get('/ad_get/{adGet}',[APIGetAdController::class,'show']);
});

Route::middleware('auth:sanctum')->group(function (){
   Route::get('/user', function (Request $request) {
       return $request->user();
   });

   Route::get('/ad/{ad}/like',[APISearchAdController::class,'like']);
   Route::post('/user/profile/update',[APIUserController::class,'update']);


});
