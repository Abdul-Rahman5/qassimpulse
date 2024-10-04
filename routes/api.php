<?php

use App\Http\Controllers\CustomerServiceController;
use App\Http\Controllers\DetailsPlaceController;
use App\Http\Controllers\DivideController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\ReservationsController;
use App\Http\Controllers\UserController;
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

//Authenticate
Route::controller(UserController::class, )->group(function ()  {
    //register
Route::post("register","register");
Route::post("login","login");
Route::post("logout","logout");
Route::post("forgotPassword","forgotPassword");
Route::post("restPassword","restPassword");
Route::post("newPassword","newPassword");
//proflie
Route::post("updatePassword","updatePassword");
Route::put("updateProflie","updateProflie");
// Route::get("proflie ","proflie");




});
//otp
// Route::post("number_verification",[EmailVerificationController::class,"number_verification"]);
//reservations
Route::controller(ReservationsController::class)->group(function ()  {
Route::post("addReservations","store");
Route::post("reservationsShow","show");


});
//
Route::controller(CustomerServiceController::class)->group(function () {
    Route::post("CustomerService","store");

});
//DetailsPlace
Route::controller(DetailsPlaceController::class)->group(function ()  {
    Route::get("allPlace","index");
    Route::post("detailsPlace","show");
//favorite
Route::post("Addfavorite","favorite");
Route::post("favorite","favoriteShow");
Route::post("removeFavorite","removeFavorite");
});
Route::controller(DivideController::class)->group(function ()  {
    Route::get("divide","show");
    // Route::post("AddSection","store");

});