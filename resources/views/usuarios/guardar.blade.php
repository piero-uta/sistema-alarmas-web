@extends('layouts.app')
@section('title', 'Guardar usuario')

@section('content')
<h2  class="login-page-new__main-form-title">Crear usuario</h2>

<form method="POST" class="form form__container" action="{{route('usuarios.handleGuardar')}}">
    @csrf
    @if(isset($usuario))
        <input type="hidden" name="id" value="{{$usuario->id}}">
    @endif

    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre*</label>
        <input type="text" class="form-control" name="nombre" required
        value="{{ old('nombre')==null ? ( isset($usuario)?$usuario->nombre:'' ) : old('name') }}">
    </div>
    <div class="mb-3">
        <label for="apellido_paterno" class="form-label">Apellido paterno*</label>
        <input type="text" class="form-control" name="apellido_paterno" required
        value="{{ old('apellido_paterno')==null ? ( isset($usuario)?$usuario->apellido_paterno:'' ) : old('apellido_paterno') }}">
    </div>
    <div class="mb-3">
        <label for="apellido_materno" class="form-label">Apellido materno</label>
        <input type="text" class="form-control" name="apellido_materno" 
        value="{{ old('apellido_materno')==null ? ( isset($usuario)?$usuario->apellido_materno:'' ) : old('apellido_materno') }}">
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email*</label>
        <input type="email" class="form-control" name="email" required
        value="{{ old('email')==null ? ( isset($usuario)?$usuario->email:'' ) : old('email') }}">
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password*</label>
        <input type="password" class="form-control" name="password" required>
    </div>
    {{-- checkbox para saber si esta activo --}}
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="activo" id="activo" 
        {{ old('activo')==null 
            ? ( isset($usuario) && $usuario->activo==0 ? '' : 'checked' ) 
            : ( old('activo')==1 ? 'checked' : '' ) }}>
        <label class="form-check-label" for="activo">
            Activo
        </label>

    </div>



    <div class="d-grid gap-2 py-2">
    <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
</form>


@endsection
