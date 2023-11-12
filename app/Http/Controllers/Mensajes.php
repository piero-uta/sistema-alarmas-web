<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Alarma;


class Mensajes extends Controller
{
    public function updateToken(Request $request){
        try{
            $request->user()->update(['token_web'=>$request->token]);
            return response()->json([
                'success'=>true
            ]);
        }catch(\Exception $e){
            report($e);
            return response()->json([
                'success'=>false
            ],500);
        }
    }
    public function getAlarmas(Request $request){
        try{
            $comunidad_id= session('comunidad_id');

            $alarmas = Alarma::join('direcciones', 'alarmas.direccion_id', '=', 'direcciones.id')
             ->join('comunidades', 'comunidades.id', '=', 'direcciones.comunidad_id')
             ->where('comunidades.id', $comunidad_id)
             ->where('alarmas.chequeo', 0)
             ->select('alarmas.*') //, 'direcciones.*', 'comunidades.*'
             ->get()
             ->toArray();
             return $alarmas;
        }catch(\Exception $e){
            report($e);
            return [];
        }
    }

}
