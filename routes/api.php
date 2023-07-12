<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TripController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DriverController;

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

Route::post('/login',[LoginController::class,'login']);
Route::post('/login/verify',[LoginController::class,'verify']);


Route::middleware('auth:sanctum')->group(function(){

    Route::get('/driver',[DriverController::class,'show']);
    Route::post('/driver',[DriverController::class,'update']);


    Route::post('/trip',      [TripController::class,'store']);
    Route::get('/trip/{trip}',[TripController::class,'show']);

    Route::post('/trip/{trip}/accept',  [TripController::class,'accept']);
    Route::post('/trip/{trip}/start',   [TripController::class,'start']);
    Route::post('/trip/{trip}/end',     [TripController::class,'end']);
    Route::post('/trip/{trip}/location',[TripController::class,'location']);

    Route::get('/user',function(Request $request){
        return $request->user();
    });
    
});

