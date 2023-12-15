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
use App\Models\TipoChequeo;
use App\Models\TipoEvento;

class Chequeos extends Controller
{
    // index
    public function index()
    {
        //obtener comunidad en session
        $comunidadId = Session::get('comunidad_id');
        // obtener direccion de la comunidad
        $direcciones = Direccion::where('comunidad_id', $comunidadId)->get();
        // obtener las alarmas de la dirreciones
        $alarmas = Alarma::whereIn('direccion_id', $direcciones->pluck('id'))->get();
        // obtener chqueos de las alarmas
        //$chequeos = Chequeo::whereIn('alarma_id', $alarmas->pluck('id'))->get();
        // join de alarmas y chequeos
        $chequeos = Alarma::join('chequeos', 'alarmas.id', '=', 'chequeos.alarma_id')
        ->select('chequeos.*','alarmas.id as id_alarma', 'alarmas.fecha as fecha_alarma', 'alarmas.hora as hora_alarma', 'alarmas.codigo as codigo_alarma')
        ->get();
        //dd($chequeos);


        // retornar la vista chequeos.index
        return view('chequeos.index', ['chequeos' => $chequeos]);
    }

    // create
    public function formularioGuardar(Request $request)
    {   
        $parametros = [];
        if($request->has('id'))
        {        
            $chequeoId = $request->input('id'); // Obtén el valor del parámetro "chequeo_id" de la solicitud

            $comunidadId = Session::get('comunidad_id'); // Obtén el ID de la comunidad desde la sesión
            $comunidad = Comunidad::find($comunidadId);
            $parametros['comunidad'] = $comunidad;
            // Obtener direcciones de la comunidad
            $direcciones = Direccion::where('comunidad_id', $comunidadId)->get();
            // Obtener las alarmas de las direcciones
            $alarmas = Alarma::whereIn('direccion_id', $direcciones->pluck('id'))->get();
            // obtener chqueos de las alarmas
            //$chequeos = Chequeo::whereIn('alarma_id', $alarmas->pluck('id'))->get();
            // join de alarmas y chequeos

            $chequeo = Chequeo::join('alarmas', 'chequeos.alarma_id', '=', 'alarmas.id')
            ->join('direcciones', 'alarmas.direccion_id', '=', 'direcciones.id')
            ->where('chequeos.id', $chequeoId)
            ->select('chequeos.*', 'alarmas.id as id_alarma', 'alarmas.fecha as fecha_alarma', 
            'alarmas.hora as hora_alarma', 'direcciones.calle as calle_direccion',
             'direcciones.numero as numero_direccion','alarmas.codigo as codigo_alarma', 'alarmas.nombre_usuario as nombre_usuario', 
             'direcciones.latitud as latitud', 'direcciones.longitud as longitud')
            ->first();
            //dd($chequeo);
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
            if($chequeo->usuario_chequeo == null && $chequeo->alarma_id != null){
                $user = Auth::user();
                $chequeo->usuario_chequeo = $user->nombre;
                $chequeo->estado_chequeo = 1;
                $alarma = Alarma::find($chequeo->alarma_id);
                $alarma->chequeo = 1;
                $chequeo->fecha = $fechaChile;
                $chequeo->hora = $horaChile; 
                $alarma->save();           
                $chequeo->save();
                 
                //dd($chequeo);       
                //dd($chequeo);       
            }

            $parametros['chequeo'] = $chequeo;            
        }
        $tipoChequeos = TipoChequeo::all();
        $tipoEventos = TipoEvento::all();
        $parametros['tiposChequeo'] = $tipoChequeos;
        $parametros['tiposEvento'] = $tipoEventos;
        return view('chequeos.guardar', $parametros);
    }


    public function handleGuardar(Request $request)
    {

        $comunidad_id = Session::get('comunidad_id');
        if($request->has('id')){

            $chequeo = Chequeo::find($request->input('id'));

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
        $chequeo->save();
        return redirect()->route('monitoreo.index');
    }
   
}
