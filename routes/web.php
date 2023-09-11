<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Comunidades;

Route::get('/comunidades', [Comunidades::class, 'index'])->name('comunidades.index');
Route::get('/comunidades/crear', [Comunidades::class, 'formularioGuardar'])->name('comunidades.crearEditar');

Route::get('/', function () {
    return view('welcome');
});
