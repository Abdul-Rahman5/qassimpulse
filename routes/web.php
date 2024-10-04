<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerServiceController;
use App\Http\Controllers\DetailsPlaceController;
use App\Http\Controllers\DivideController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::middleware("is_admin")->group(function ()  {

    Route::get('admin1',[AuthController::class,'admin1']);

    //add section
    Route::get('createSection',[DivideController::class,'create']);
    Route::post('storeSection',[DivideController::class,'store']);
    Route::get('allSection',[DivideController::class,'index']);
    Route::get('showSection/{id}',[DivideController::class,'showSection']);
    Route::get('div/edit/{id}',[DivideController::class,'edit']);
    Route::put('div/update/{id}',[DivideController::class,'update']);
    Route::delete('div/delete/{id}',[DivideController::class,'destroy']);


    //add deateils place
    Route::get('createPlace',[DetailsPlaceController::class,'create']);
    Route::post('storePlace',[DetailsPlaceController::class,'storePlace']);
    Route::get('allPlace',[DetailsPlaceController::class,'allPlace']);
    Route::get('showPlace/{id}',[DetailsPlaceController::class,'showPlace']);
    Route::get('Place/edit/{id}',[DetailsPlaceController::class,'showPlaceEdit']);
    Route::put('PlaceUpdate/{id}',[DetailsPlaceController::class,'PlaceUpdate']);
    Route::delete('Placedelete/{id}',[DetailsPlaceController::class,'destroy']);

    //contect
    Route::get('contect',[CustomerServiceController::class,'show']);
    //logout
    Route::post("logout",[AuthController::class,"logout"]);

});
Route::middleware("guest")->group(function ()  {

    // //register auth

    Route::get("register",[AuthController::class,"register"]);
    Route::post("register",[AuthController::class,"store"]);
    //auth
    Route::get("/",[AuthController::class,"create"])->name('login');
    Route::post("login",[AuthController::class,"login"]);
});


