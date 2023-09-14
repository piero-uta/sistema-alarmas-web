@extends('layouts.app')
@section('title', 'Guardar comunidad')

@section('content')
<h2>Crear comunidad</h2>

<form method="POST" action="{{route('comunidades.handleGuardar')}}">
    @csrf
    @if(isset($comunidad))
        <input type="hidden" name="id" value="{{$comunidad->id}}">
    @endif

    <div class="mb-3">
        <label for="rut" class="form-label">Rut*</label>
        <input type="number" class="form-control" name="rut" required
        value="{{ old('rut')==null ? ( isset($comunidad)?$comunidad->rut:'' ) : old('rut') }}">
    </div>
    <div class="mb-3">
        <label for="digito" class="form-label">Digito*</label>
        <input type="text" class="form-control" name="digito"required
        value="{{ old('digito')==null ? ( isset($comunidad)?$comunidad->digito:'' ) : old('digito') }}">
    </div>
    <div class="mb-3">
        <label for="razon_social" class="form-label">Razon social*</label>
        <input type="text" class="form-control" name="razon_social" required
        value="{{ old('razon_social')==null ? ( isset($comunidad)?$comunidad->razon_social:'' ) : old('razon_social') }}">
    </div>
    <div class="mb-3">
        <label for="representante_legal" class="form-label">Representante legal</label>
        <input type="text" class="form-control" name="representante_legal" 
        value="{{ old('representante_legal')==null ? ( isset($comunidad)?$comunidad->representante_legal:'' ) : old('representante_legal') }}">
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" name="email"
        value="{{ old('email')==null ? ( isset($comunidad)?$comunidad->email:'' ) : old('email') }}">
    </div>
    <div class="mb-3">
        <label for="direccion" class="form-label">Dirección*</label>
        <input type="text" class="form-control" name="direccion" required
        value="{{ old('direccion')==null ? ( isset($comunidad)?$comunidad->direccion:'' ) : old('direccion') }}">
    </div>
    <div class="mb-3">
        <label for="giro" class="form-label">Giro</label>
        <input type="text" class="form-control" name="giro" 
        value="{{ old('giro')==null ? ( isset($comunidad)?$comunidad->giro:'' ) : old('giro') }}">
    <div class="mb-3">
        <label for="tipo_servicio" class="form-label">Tipo servicio*</label>
        <input type="text" class="form-control" name="tipo_servicio" required
        value="{{ old('tipo_servicio')==null ? ( isset($comunidad)?$comunidad->tipo_servicio:'' ) : old('tipo_servicio') }}">
    </div>
    <div class="mb-3">
        <label for="costo_mensual" class="form-label">Costo mensual*</label>
        <input type="number" class="form-control" name="costo_mensual" required
        value="{{ old('costo_mensual')==null ? ( isset($comunidad)?$comunidad->costo_mensual:'' ) : old('costo_mensual') }}">
    </div>
    <div class="mb-3">
        <label for="telefono" class="form-label">Telefono</label>
        <input type="number" class="form-control" name="telefono" 
        value="{{ old('telefono')==null ? ( isset($comunidad)?$comunidad->telefono:'' ) : old('telefono') }}">
    </div>
    <div class="mb-3">
        <label for="celular" class="form-label">Celular</label>
        <input type="number" class="form-control" name="celular" 
        value="{{ old('celular')==null ? ( isset($comunidad)?$comunidad->celular:'' ) : old('celular') }}">
    </div>
    {{-- checkbox para saber si esta activo --}}
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="activo" id="activo" 
        {{ old('activo')==null ? ( isset($comunidad) && $comunidad->activo==1 ? 'checked' : '' ) : ( old('activo')==1 ? 'checked' : '' ) }}>
        <label class="form-check-label" for="activo">
            Activo
        </label>

    </div>

    <button type="submit" class="btn btn-primary">Guardar</button>
</form>


@endsection