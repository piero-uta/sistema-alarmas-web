<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comunidad;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Models\User;
use App\Models\UsuarioComunidad;
use App\Models\Direccion;
use App\Models\Alarma;
use App\Models\Chequeo;
use Carbon\Carbon;

class Chequeos extends Controller
{
    // index
    public function index()
    {
        //obtener comunidad en session
        $comunidad_id = Session::get('comunidad_id');
        // obtener direccion de la comunidad
        $direcciones = Direccion::where('comunidad_id', $comunidad_id)->get();
        // obtener las alarmas de la dirreciones
        $alarmas = Alarma::whereIn('direccion_id', $direcciones->pluck('id'))->get();
        // obtener chqueos de las alarmas
        //$chequeos = Chequeo::whereIn('alarma_id', $alarmas->pluck('id'))->get();
        $chequeos = Chequeo::all();
        // Agregar el código de alarma a cada chequeo
        $chequeos->each(function ($chequeo) use ($alarmas) 
        {  
            $codigoAlarma = $alarmas->where('id', $chequeo->alarma_id)->first()->codigo;
            $chequeo->codigo_alarma = $codigoAlarma; // Agrega el código de alarma al objeto chequeo
        });
        // retornar la vista chequeos.index
        return view('chequeos.index', compact('chequeos'));
    }

    // create
    public function formularioGuardar(Request $request)
    {
        $parametros = [];
        if($request->has('id')){    
            // verificar comunidad 
            $comunidad = Session::get('comunidad_id');
            $chequeo = Chequeo::all()->first();
            if(!$chequeo)
            {
                //agregar error a parametros
                $parametros['error'] = 'Chequeo no encontrada';
                return redirect()->route('chequeos.index')->with($parametros);
            }       
        // Compara el estado actual con el estado enviado desde el formulario
        $parametros['chequeo'] = new Chequeo();
        // Obtener la fecha y hora actual de Chile
        $fechaChile = Carbon::now('America/Santiago')->toDateString(); // Obtiene la fecha en formato 'Y-m-d'
        // Puedes formatear la fecha y hora según tus necesidades
        $horaChile = Carbon::now('America/Santiago')->toTimeString(); // Obtiene la hora en formato 'H:i:s'
        //dd($fechaChile, $horaChile)
        if($chequeo->usuario_chequeo == null){
            $user = Auth::user();
            $chequeo->usuario_chequeo = $user->nombre;
            $chequeo->estado_chequeo = 1;
            $chequeo->fecha = $fechaChile;
            $chequeo->hora = $horaChile;
        }

        
        $chequeo->save();
        $parametros['chequeo'] = $chequeo;            
        }

        return view('chequeos.guardar', $parametros);
    }


    public function handleGuardar(Request $request)
    {

        $comunidad_id = Session::get('comunidad_id');
        if($request->has('id')){
            $chequeo = Chequeo::where('id', $request->id)->where('comunidad_id', $comunidad_id)->first();
            if(!$chequeo){
                //agregar error a parametros
                $parametros['error'] = 'Chequeo no encontrada';
                return redirect()->route('chequeos.index')->with($parametros);
            }

        }else{
            $chequeo = new Chequeo();
        }
        $chequeo->usuario_chequeo = $request->usuario_chequeo;
        $chequeo->vecino_chequeo = $request->vecino_chequeo;
        $chequeo->observacion = $request->observacion;
        $chequeo->tipo_chequeo = $request->tipo_chequeo;
        $chequeo->tipo_evento = $request->tipo_evento;
        $chequeo->alarma_id = $request->alarma_id;
        $chequeo->save();

        return redirect()->route('chequeos.index');
    }
   
}
