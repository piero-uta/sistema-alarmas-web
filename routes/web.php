<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Comunidades;
use App\Http\Controllers\Usuarios;
use App\Http\Controllers\Autenticacion;
use App\Http\Controllers\Direcciones;

Route::get('/', function () {
    return view('welcome');
});

// AUTENTICACION
Route::get('/login', [Autenticacion::class, 'formularioLogin'])->name('login');
Route::post('/login', [Autenticacion::class, 'handleLogin'])->name('login.handleLogin');
Route::get('/logout', [Autenticacion::class, 'handleLogout'])->name('logout');

// COMUNIDADES
Route::get('/comunidades', [Comunidades::class, 'index'])->name('comunidades.index');
Route::get('/comunidades/crear', [Comunidades::class, 'formularioGuardar'])->name('comunidades.crearEditar');
Route::post('/comunidades/guardar', [Comunidades::class, 'handleGuardar'])->name('comunidades.handleGuardar');
Route::post('/comunidades/eliminar', [Comunidades::class, 'eliminar'])->name('comunidades.eliminar');

// USUARIO PROVICIONAL
Route::get('/usuarios', [Usuarios::class, 'index'])->name('usuarios.index');
Route::get('/usuarios/crear', [Usuarios::class, 'formularioGuardar'])->name('usuarios.crearEditar');
Route::post('/usuarios/guardar', [Usuarios::class, 'handleGuardar'])->name('usuarios.handleGuardar');
Route::post('/usuarios/eliminar', [Usuarios::class, 'eliminar'])->name('usuarios.eliminar');

// DIRECCIONES PROVICIONAL
Route::get('/direcciones', [Direcciones::class, 'index'])->name('direcciones.index');
Route::get('/direcciones/crear', [Direcciones::class, 'formularioGuardar'])->name('direcciones.crearEditar');
Route::post('/direcciones/guardar', [Direcciones::class, 'handleGuardar'])->name('direcciones.handleGuardar');
Route::post('/direcciones/eliminar', [Direcciones::class, 'eliminar'])->name('direcciones.eliminar');



