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
        $chequeos = Chequeo::whereIn('alarma_id', $alarmas->pluck('id'))->get();
        // retornar la vista chequeos.index
        // Obtener la hora actual de Chile
        $horaChile = Carbon::now('America/Santiago');
        //dd($horaChile);
        return view('chequeos.index', compact('chequeos'));
    }
    public function formularioGuardar(Request $request)
    {
        $parametros = [];
        $comunidad_id = Session::get('comunidad_id');
        if($request->has('id')){
            $chequeo = Chequeo::find($request->id);
            if(!$chequeo){
                //agregar error a parametros
                $parametros['error'] = 'Chequeo no encontrada';
                return redirect()->route('chequeos.index')->with($parametros);
            }
            $parametros['chequeo'] = $chequeo;
        }
        // obtener direcciones
        $direcciones = Direccion::where('comunidad_id', $comunidad_id)->get();
        $parametros['direcciones'] = $direcciones;
        return view('chequeos.guardar', $parametros);
    }
   
}
