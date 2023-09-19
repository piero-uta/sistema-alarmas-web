<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class Autenticacion extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        //obtener los datos del request
        $credentials = $request->only('email', 'password');



        
        if(Auth::attempt($credentials))
        {
            $user = User::where('email', $request->email)->first();
            $token = $user->createToken('authToken')->plainTextToken;
            return response()->json(['token' => $token, 'user'=>$user], 200);
        }
        else
        {
            return response()->json(['error' => 'Usuario o contraseña incorrecta'], 401);
        }
        
    }
}
