<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Comunidades;
use App\Http\Controllers\Usuarios;
use App\Http\Controllers\Autenticacion;
use App\Http\Controllers\Direcciones;
use App\Http\Controllers\Perfiles;
use App\Http\Controllers\RedesAvisos;
use App\Http\Controllers\Chequeos;
use Carbon\Carbon;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Login de usuarios
Route::controller(Autenticacion::class)->group(function () {
    Route::get('/login', 'formularioLogin')->name('login');
    Route::post('/login', 'handleLogin')->name('login.handleLogin');
    Route::get('/logout', 'handleLogout')->name('logout');
});

// Login admin
Route::controller(Autenticacion::class)->group(function () {
    Route::get('/loginAdmin', 'formularioLoginAdmin')->name('loginAdmin');
    Route::post('/loginAdmin', 'handleLoginAdmin')->name('loginAdmin.handleLoginAdmin');
    Route::get('/logoutAdmin', 'handleLogoutAdmin')->name('logoutAdmin');
});

// Rutas de administrador
Route::middleware(['auth:admin'])->group(function () {
    
});   


// Rutas de usuarios
Route::middleware(['auth'])->group(function () {

    
        
    
    Route::controller(Comunidades::class)->group(function () {
        // Route::middleware('permisos:admin')->group(function () {
            Route::get('/comunidades', 'index')->name('comunidades.index');
            Route::get('/comunidades/crear', 'formularioGuardar')->name('comunidades.crearEditar');
            Route::post('/comunidades/guardar', 'handleGuardar')->name('comunidades.handleGuardar');
            Route::post('/comunidades/eliminar', 'eliminar')->name('comunidades.eliminar');
        // });
        Route::get('/comunidades/ver', 'comunidadesUsuario')->name('comunidades.ver');
        Route::get('/comunidades/seleccionar/{comunidad_id}', 'handleSeleccionarComunidad')->name('comunidades.seleccionar');
    });

    Route::controller(Perfiles::class)->group(function () {
        Route::get('/perfiles', 'index')->name('perfiles.index');
        Route::post('/perfiles/guardar', 'handleGuardar')->name('perfiles.handleGuardar');
        Route::post('/perfiles/eliminar', 'eliminar')->name('perfiles.eliminar');
    });

    Route::controller(Direcciones::class)->group(function () {
        Route::get('/direcciones', 'index')->name('direcciones.index');
        Route::get('/direcciones/crear', 'formularioGuardar')->name('direcciones.crearEditar');
        Route::post('/direcciones/guardar', 'handleGuardar')->name('direcciones.handleGuardar');
        Route::post('/direcciones/eliminar', 'eliminar')->name('direcciones.eliminar');
    });
    
    Route::controller(Usuarios::class)->group(function () {
        Route::get('/usuarios', 'index')->name('usuarios.index');
        Route::get('/usuarios/crear', 'formularioGuardar')->name('usuarios.crearEditar');
        Route::post('/usuarios/guardar', 'handleGuardar')->name('usuarios.handleGuardar');
        Route::post('/usuarios/eliminar', 'eliminar')->name('usuarios.eliminar');
    });

    Route::controller(RedesAvisos::class)->group(function () {
        Route::get('/red-avisos', 'index')->name('red-avisos.index');
        Route::get('/red-avisos/crear', 'formularioGuardar')->name('red-avisos.crearEditar');
        Route::post('/red-avisos/guardar', 'handleGuardar')->name('red-avisos.handleGuardar');
        Route::post('/red-avisos/eliminar', 'eliminar')->name('red-avisos.eliminar');
    });
    Route::controller(Chequeos::class)->group(function () {
        Route::get('/chequeos', 'index')->name('chequeos.index');
        Route::get('/chequeos/crear', 'formularioGuardar')->name('chequeos.crearEditar');
        Route::post('/chequeos/guardar', 'handleGuardar')->name('chequeos.handleGuardar');
        Route::post('/chequeos/eliminar', 'eliminar')->name('chequeos.eliminar');
    });
    
});



