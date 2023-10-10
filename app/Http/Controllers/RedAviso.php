<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comunidad;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Models\User;
use App\Models\UsuarioComunidad;

class RedAviso extends Controller
{
    public function index()
    {
        return view('redAviso.index');
    }
}
