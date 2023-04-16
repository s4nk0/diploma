<?php

use App\Facades\SMS;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\User\UserAddController;
use App\Http\Controllers\User\UserGetAdController;
use App\Http\Controllers\User\UserLikedAdController;
use App\Http\Controllers\User\UserSearchAddController;
use App\SMS\SMSCTest;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('pages.index');
});

Route::get('/search/{search?}', [SearchController::class,'index'])->name('search');

Route::get('/login/email', function () {
    return view('auth.login-email');
})->name('login.email');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
//    Route::get('/dashboard', function () {
//        return view('dashboard');
//    })->name('dashboard');

    Route::name('user.')->prefix('user')->group(function (){
        Route::get('liked',[UserLikedAdController::class,'index'])->name('liked');
    });
});

Route::name('user.')->group(function (){
    Route::resource('search_ad',UserSearchAddController::class);
    Route::resource('get_ad',UserGetAdController::class);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
