<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comunidad;

class Comunidades extends Controller
{
    public function index()
    {
        return view('comunidades.index');
    }

    public function formularioGuardar(Request $request)
    {
        return view('comunidades.guardar');
    }

    public function handleGuardar(Request $request)
    {
        $request->validate([
            'razon_social' => 'required',
            'rut' => 'required',
            'digito' => 'required',
            'direccion' => 'required',
            'tipo_servicio' => 'required',
            'costo_mensual' => 'required',

        ]);
        $comunidad = new Comunidad();
        $comunidad->razon_social = $request->razon_social;
        $comunidad->rut = $request->rut;
        $comunidad->digito = $request->digito;
        $comunidad->direccion = $request->direccion;
        $comunidad->tipo_servicio = $request->tipo_servicio;
        $comunidad->costo_mensual = $request->costo_mensual;
        $comunidad->save();
        return redirect()->route('comunidades.index');
    }
    

}
