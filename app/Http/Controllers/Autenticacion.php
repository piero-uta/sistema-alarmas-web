<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class Autenticacion extends Controller
{
    //
    public function formularioLogin()
    {
        if(Auth::check()){
            return view('main-dashboard');
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
            return view('main-dashboard');
        }
        //agregar error a parametros
        $parametros['error'] = 'Usuario o contraseña incorrectos';
        return redirect()->route('login')->with($parametros);
    }

    public function handleLogout()
    {
        Auth::logout();
        // Eliminar 'permisos' de la sesión
        Session::forget('permisos');
        // Eliminar 'comunidad_id' de la sesión
        Session::forget('comunidad_id');
        Session::forget('comunidad_logo');
        Session::forget('perfil_actual');

        return redirect()->route('login');
    }

    public function formularioLoginAdmin()
    {
        if(Auth::guard('admin')->check()){
            return redirect()->route('comunidades.index');
        }
        return view('autenticacion.loginAdmin');
    }

    public function handleLoginAdmin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        //obtener los datos del request
        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        //verificar si el usuario existe
        if (Auth::guard('admin')->attempt($credentials, $remember)) {
            // Authentication passed...
            return redirect()->route('comunidades.index');
        }
        //agregar error a parametros
        $parametros['error'] = 'Usuario o contraseña incorrectos';
        return redirect()->route('loginAdmin')->with($parametros);
    }

    public function handleLogoutAdmin()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('loginAdmin');
    }

}
