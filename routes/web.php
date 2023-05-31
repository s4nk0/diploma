<?php

use App\Enums\RolesEnum;
use App\Facades\SMS;
use App\Http\Controllers\Admin\AdminAdGenderTypeController;
use App\Http\Controllers\Admin\AdminApartmentConditionController;
use App\Http\Controllers\Admin\AdminApartmentFacilitiesController;
use App\Http\Controllers\Admin\AdminApartmentForController;
use App\Http\Controllers\Admin\AdminApartmentFurnitureController;
use App\Http\Controllers\Admin\AdminApartmentFurnitureStatusController;
use App\Http\Controllers\Admin\AdminApartmentSecurityController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminRequestsController;
use App\Http\Controllers\Admin\AdminRoleController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\User\UserAddController;
use App\Http\Controllers\User\UserGetAdController;
use App\Http\Controllers\User\UserLikedAdController;
use App\Http\Controllers\User\UserSearchAddController;
use App\SMS\SMSCTest;
use Illuminate\Auth\Events\Verified;
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

Route::get('/map',[MapController::class,'index'])->name('map');

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

    Route::name('admin.')->prefix('admin')->middleware(['role:'.RolesEnum::Admin->value])->group(function (){
        Route::get('/',[AdminController::class,'index'])->name('dashboard');
        Route::resource('user',AdminUserController::class);
        Route::get('/user/{user}/search_ad',[AdminUserController::class,'search_ad'])->name('user.search_ad');
        Route::get('/user/{user}/get_ad',[AdminUserController::class,'get_ad'])->name('user.get_ad');
        Route::get('/user/{user}/favorites',[AdminUserController::class,'favorites'])->name('user.favorites');

        Route::get('/user/{user}/roles',[AdminUserController::class,'role'])->name('user.role');
        Route::put('/user/{user}/roles',[AdminUserController::class,'updateUserRole'])->name('user.role.update');

        Route::resource('apartmentCondition', AdminApartmentConditionController::class)->except(['show']);
        Route::resource('adGenderType', AdminAdGenderTypeController::class)->except(['show']);
        Route::resource('apartmentFurnitureStatus', AdminApartmentFurnitureStatusController::class)->except(['show']);
        Route::resource('apartmentFurniture', AdminApartmentFurnitureController::class)->except(['show']);
        Route::resource('apartmentFacility', AdminApartmentFacilitiesController::class)->except(['show']);
        Route::resource('apartmentSecurity', AdminApartmentSecurityController::class)->except(['show']);
        Route::resource('apartmentFor', AdminApartmentForController::class)->except(['show']);
        Route::get('/requests',[AdminRequestsController::class,'index'])->name('request.index');
        Route::get('/requests/search_ad/{search_ad}',[AdminRequestsController::class,'searchAdRequestShow'])->name('request.search_ad.show');
        Route::get('/requests/search_ad/{search_ad}/accept',[AdminRequestsController::class,'searchAdRequestAccept'])->name('request.search_ad.accept');
        Route::post('/requests/search_ad/{search_ad}/decline',[AdminRequestsController::class,'searchAdRequestDecline'])->name('request.search_ad.decline');
        Route::get('/requests/get_ad/{get_ad}',[AdminRequestsController::class,'getAdRequestShow'])->name('request.get_ad.show');
        Route::get('/requests/get_ad/{get_ad}/accept',[AdminRequestsController::class,'getAdRequestAccept'])->name('request.get_ad.accept');
        Route::post('/requests/get_ad/{get_ad}/decline',[AdminRequestsController::class,'getAdRequestDecline'])->name('request.get_ad.decline');


    });
});

Route::name('user.')->group(function (){
    Route::resource('search_ad',UserSearchAddController::class);
    Route::resource('get_ad',UserGetAdController::class);
});

Route::get('/email/verify/{id}/{hash}', function (\Illuminate\Http\Request $request) {
    $user = \App\Models\User::find($request->id);

    if ($user){
        $valid = true;
        if (! hash_equals((string) $user->getKey(), (string) $request->id)) {
            $valid = false;
        }

        if (! hash_equals(sha1($user->getEmailForVerification()), (string) $request->hash)) {
            $valid = false;
        }
        if ($valid && ! $user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();

            event(new Verified($user));
            return redirect('/?verified=1');
        }

    }

    return redirect('/');
})->name('verification.verify');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
