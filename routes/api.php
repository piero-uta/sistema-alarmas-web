<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Autenticacion;
use App\Http\Controllers\Api\Alarmas;
use App\Models\Alarma;
use App\Models\UsuarioComunidad;

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

Route::group(['middleware'=>['cors']], function(){

    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });
    Route::middleware('auth:sanctum')->get('/comunities', function (Request $request) {
        $user = $request->user();
        $comunities = $user->comunidades();

        $Filter_comunities = array_unique($comunities);
        return $Filter_comunities;
    });

    Route::middleware('auth:sanctum')->post('/checkAlarms', function (Request $request) {
        $user = $request->user();
        $comunidad_id = $request['comunidad_id'];
        $nombre = $user->nombre;

        $usuarioComunidad = UsuarioComunidad::where('usuario_id', $user->id)
        ->where('comunidad_id', $comunidad_id)
        ->first();

        $direccion_id = $usuarioComunidad ->direccion_id;
        $alarmas = Alarma::where('nombre_usuario', $nombre)
        ->where('direccion_id', $direccion_id)
        ->where('chequeo', 0)
        ->get()
        ->toArray();

        return $alarmas;
        });


    Route::post('/login', [Autenticacion::class, 'login'])->name('api.login');
    Route::get('/getAlarms', [Alarmas::class,'getAlarms'])->name('getAlarms');


    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::post('/save-fcmtoken', [Alarmas::class, 'saveFCMToken'])->name('saveFCMToken');
        Route::post('/send-notification', [Alarmas::class,'sendNotification'])->name('sendNotification');
    });
});



