<?php

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

//public
Route::post('/register', [\App\Http\Controllers\RegisterController::class,'register']);
Route::post('/login', [\App\Http\Controllers\RegisterController::class,'login']);

//protected
Route::group(['middleware' => 'auth:sanctum'], function(){
    Route::resource('/review', \App\Http\Controllers\ReviewController::class);
});
