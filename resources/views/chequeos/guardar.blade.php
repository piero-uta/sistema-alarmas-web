@extends('layouts.app')
@section('title', 'Guardar $chequeo')

@section('content')
<h1 class="login-page-new__main-form-title"style="padding-top: 5rem;">modificar Chequeo</h1>

<form method="POST" class="form form__container" action ="{{route('chequeos.handleGuardar')}}">
    @csrf
    @if(isset($chequeo))
        <input type="hidden" name="id" value="{{$chequeo->id}}">
    @endif
    

    <div >
        <label for="fecha" class="label">Fecha*</label>
        <input type="date" class="input" name="fecha"
        value="{{ old('fecha')==null ? ( isset($chequeo)?$chequeo->fecha:'' ) : old('fecha') }}">
    </div>
    <div >
        <label for="hora" class="label">Hora*</label>
        <input type="time" class="input" name="hora" 
        value="{{ old('hora')==null ? ( isset($chequeo)?$chequeo->hora:'' ) : old('hora') }}">
    </div>
    <div >
        <label for="usuario_chequeo" class="label">Usuario chequeo*</label>
        <input type="text" class="input" name="usuario_chequeo" required
        value="{{ old('usuario_chequeo')==null ? ( isset($chequeo)?$chequeo->usuario_chequeo:'' ) : old('usuario_chequeo') }}"readonly>
    </div>

    <div >
        <label for="vecino_chequeo" class="label">Vecino chequeo*</label>
        <input type="text" class="input" name="vecino_chequeo" required
        value="{{ old('vecino_chequeo')==null ? ( isset($chequeo)?$chequeo->vecino_chequeo:'' ) : old('vecino_chequeo') }}"readonly>
    </div>
    <div >
        <label for="observacion" class="label">Observacion*</label>
        <input type="text" class="input" name="observacion" 
        value="{{ old('observacion')==null ? ( isset($chequeo)?$chequeo->observacion:'' ) : old('observacion') }}">
    </div>
    <div >
        <label for="tipo_chequeo" class="label">Tipo chequeo*</label>
        <input type="text" class="input" name="tipo_chequeo" 
        value="{{ old('tipo_chequeo')==null ? ( isset($chequeo)?$chequeo->tipo_chequeo:'' ) : old('tipo_chequeo') }}">
    </div>
    <div >
        <label for="tipo_evento" class="label">Tipo evento*</label>
        <input type="text" class="input" name="tipo_evento" 
        value="{{ old('tipo_evento')==null ? ( isset($chequeo)?$chequeo->tipo_evento:'' ) : old('tipo_evento') }}">
    </div>
    <div class="d-flex justify-content-end py-2">
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>

</form>