<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comunidad;
use App\Models\Direccion;
use App\Models\Alarma;
use Illuminate\Support\Facades\Session;

class Monitoreo extends Controller
{
    //
    public function index()
    {
        //obtener la comunidad seleccionada
        $comunidad_id = Session::get('comunidad_id');
        $comunidad = Comunidad::find($comunidad_id);
        //obtener todas las direcciones de la comunidad
        $direcciones = Direccion::where('comunidad_id', $comunidad_id)->get();

        // //obtener alarmas de las direcciones
        // $alarmas = Alarma::whereIn('direccion_id', $direcciones->pluck('id'))->get();

        // dd($alarmas);

        $parametros = [
            'comunidad' => $comunidad,
            'direcciones' => $direcciones,
        ];

        return view('monitoreo.index', $parametros);

    }

    public function getAlarmas(Request $request)
    {
        //obtener la comunidad seleccionada
        $comunidad_id = $request->comunidad_id;
        $comunidad = Comunidad::find($comunidad_id);
        //obtener todas las direcciones de la comunidad
        $direcciones = Direccion::where('comunidad_id', $comunidad_id)->get();
        //obtener alarmas de las direcciones
        $alarmas = Alarma::whereIn('direccion_id', $direcciones->pluck('id'))->get();

        return response()->json([
            'alarmas' => $alarmas, 
        ], 200);

    }
}
