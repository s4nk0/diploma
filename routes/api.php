<?php

use App\Http\Controllers\API\ApiAdGenderTypeController;
use App\Http\Controllers\API\ApiCityController;
use App\Http\Controllers\API\APIGenderController;
use App\Http\Controllers\API\APIGetAdController;
use App\Http\Controllers\API\APISearchAdController;
use App\Http\Controllers\API\ApiSearchController;
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
Route::post('/logout',[AuthController::class,'logout']);
Route::post('/register/email',[AuthController::class,'emailRegister']);
Route::get('/search/{search?}',[ApiSearchController::class,'search']);
Route::get('/ad_gender_types',[ApiAdGenderTypeController::class,'index']);
Route::get('/cities',[ApiCityController::class,'index']);
Route::get('/search_ad/relations',[APISearchAdController::class,'relationDates']);

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
   Route::get('/user/liked',[APIUserController::class,'userLiked']);
   Route::post('/user/profile/update',[APIUserController::class,'update']);

   Route::post('/user/search_ad/store',[APISearchAdController::class,'store']);
   Route::post('/user/search_ad/{search_ad}/update',[APISearchAdController::class,'update']);
   Route::post('/user/search_ad/{search_ad}/delete',[APISearchAdController::class,'destroy']);
   Route::get('/user/search_ad',[APIUserController::class,'userSearchAd']);

   Route::post('/user/get_ad/store',[APIGetAdController::class,'store']);
   Route::post('/user/get_ad/{get_ad}/update',[APIGetAdController::class,'update']);
   Route::post('/user/get_ad/{get_ad}/delete',[APIGetAdController::class,'destroy']);
   Route::get('/user/get_ad',[APIUserController::class,'userGetAd']);


});
