@extends('layouts.app')
@section('title', 'Guardar $chequeos')

@section('content')
<h1 class="login-page-new__main-form-title"style="padding-top: 5rem;">modificar Chequeo</h1>

<form method="POST" class="form form__container" action ="{{route('chequeos.handleGuardar')}}">
    @csrf
    @if(isset($comunidad))
        <input type="hidden" name="id" value="{{$chequeos->id}}">
    @endif
    
    <div>
        <label for="alarma" class="label">Codigo*</label>
        <input type="text" class="input" name="codigo" required
        value="{{ old('codigo')==null ? ( isset($chequeos)?$chequeos->alarma:'' ) : old('codigo') }}">
    </div>
    <div >
        <label for="fecha" class="label">Fecha*</label>
        <input type="date" class="input" name="fecha"required
        value="{{ old('fecha')==null ? ( isset($chequeos)?$chequeos->fecha:'' ) : old('fecha') }}">
    </div>
    <div >
        <label for="hora" class="label">Hora*</label>
        <input type="time" class="input" name="hora" required
        value="{{ old('hora')==null ? ( isset($chequeos)?$chequeos->hora:'' ) : old('hora') }}">
    </div>
    <div >
        <label for="usuario_chequeo" class="label">Usuario chequeo*</label>
        <input type="text" class="input" name="usuario_chequeo" required
        value="{{ old('usuario_chequeo')==null ? ( isset($chequeos)?$chequeos->usuario_chequeo:'' ) : old('usuario_chequeo') }}">
    </div>
    <div >
        <label for="estado_chequeo" class="label">Estado chequeo*</label>
        <input type="text" class="input" name="estado_chequeo" required
        value="{{ old('estado_chequeo')==null ? ( isset($chequeos)?$chequeos->estado_chequeo:'' ) : old('estado_chequeo') }}">
    </div>
    <div >
        <label for="vecino_chequeo" class="label">Vecino chequeo*</label>
        <input type="text" class="input" name="vecino_chequeo" required
        value="{{ old('vecino_chequeo')==null ? ( isset($chequeos)?$chequeos->vecino_chequeo:'' ) : old('vecino_chequeo') }}">
    </div>
    <div >
        <label for="observacion" class="label">Observacion*</label>
        <input type="text" class="input" name="observacion" required
        value="{{ old('observacion')==null ? ( isset($chequeos)?$chequeos->observacion:'' ) : old('observacion') }}">
    </div>
    <div >
        <label for="tipo_chequeo" class="label">Tipo chequeo*</label>
        <input type="text" class="input" name="tipo_chequeo" required
        value="{{ old('tipo_chequeo')==null ? ( isset($chequeos)?$chequeos->tipo_chequeo:'' ) : old('tipo_chequeo') }}">
    </div>
    <div >
        <label for="tipo_evento" class="label">Tipo evento*</label>
        <input type="text" class="input" name="tipo_evento" required
        value="{{ old('tipo_evento')==null ? ( isset($chequeos)?$chequeos->tipo_evento:'' ) : old('tipo_evento') }}">
    </div>
    <div class="d-flex justify-content-end py-2">
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>

</form>