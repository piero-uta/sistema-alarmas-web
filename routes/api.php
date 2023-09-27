<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Autenticacion;
use App\Http\Controllers\Api\Alarmas;

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

Route::group(['middlware'=>['cors']], function(){

    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });
    
    Route::post('/login', [Autenticacion::class, 'login'])->name('api.login');
    
    Route::post('/send-notification', [Alarmas::class,'sendNotification'])->name('sendNotification');
    
    Route::group(['middleware' => ['auth:sanctum']], function () {    
        Route::post('/save-fcmtoken', [Alarmas::class, 'saveFCMToken'])->name('saveFCMToken');
    });
});



