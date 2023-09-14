<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Autenticacion extends Controller
{
    //
    public function formularioLogin()
    {
        if(Auth::check()){
            return redirect()->route('comunidades.index');
        }
        return view('autenticacion.login');
    }

    public function handleLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        //obtener los datos del request
        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');
        
        //verificar si el usuario existe
        if (Auth::attempt($credentials, $remember)) {
            // Authentication passed...
            return redirect()->route('comunidades.index');
        }
        //agregar error a parametros
        $parametros['error'] = 'Usuario o contraseña incorrectos';
        return redirect()->route('login')->with($parametros);
    }

    public function handleLogout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
