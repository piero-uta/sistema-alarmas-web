@extends('layouts.app')
@section('title', 'Guardar comunidad')

@section('content')
<h1 class="login-page-new__main-form-title">Crear comunidad</h1>

<form method="POST" class="form form__container"action="{{route('comunidades.handleGuardar')}}">
    @csrf
    @if(isset($comunidad))
        <input type="hidden" name="id" value="{{$comunidad->id}}">
    @endif

    <div>
        <label for="rut" class="label">Rut*</label>
        <input type="number" class="input" name="rut" required
        value="{{ old('rut')==null ? ( isset($comunidad)?$comunidad->rut:'' ) : old('rut') }}">
    </div>
    <div >
        <label for="digito" class="label">Digito*</label>
        <input type="text" class="input" name="digito"required
        value="{{ old('digito')==null ? ( isset($comunidad)?$comunidad->digito:'' ) : old('digito') }}">
    </div>
    <div >
        <label for="razon_social" class="label">Razon social*</label>
        <input type="text" class="input" name="razon_social" required
        value="{{ old('razon_social')==null ? ( isset($comunidad)?$comunidad->razon_social:'' ) : old('razon_social') }}">
    </div>
    <div >
        <label for="representante_legal" class="label">Representante legal</label>
        <input type="text" class="input" name="representante_legal" 
        value="{{ old('representante_legal')==null ? ( isset($comunidad)?$comunidad->representante_legal:'' ) : old('representante_legal') }}">
    </div>
    <div >
        <label for="email" class="label">Email</label>
        <input type="email" class="input" name="email"
        value="{{ old('email')==null ? ( isset($comunidad)?$comunidad->email:'' ) : old('email') }}">
    </div>
    <div >
        <label for="direccion" class="label">Dirección*</label>
        <input type="text" class="input" name="direccion" required
        value="{{ old('direccion')==null ? ( isset($comunidad)?$comunidad->direccion:'' ) : old('direccion') }}">
    </div>
    <div >
        <label for="giro" class="label">Giro</label>
        <input type="text" class="input" name="giro" 
        value="{{ old('giro')==null ? ( isset($comunidad)?$comunidad->giro:'' ) : old('giro') }}">
    <div >
        <label for="tipo_servicio" class="label">Tipo servicio*</label>
        <input type="text" class="input" name="tipo_servicio" required
        value="{{ old('tipo_servicio')==null ? ( isset($comunidad)?$comunidad->tipo_servicio:'' ) : old('tipo_servicio') }}">
    </div>
    <div >
        <label for="costo_mensual" class="label">Costo mensual*</label>
        <input type="number" class="input" name="costo_mensual" required
        value="{{ old('costo_mensual')==null ? ( isset($comunidad)?$comunidad->costo_mensual:'' ) : old('costo_mensual') }}">
    </div>
    <div >
        <label for="telefono" class="label">Telefono</label>
        <input type="number" class="input" name="telefono" 
        value="{{ old('telefono')==null ? ( isset($comunidad)?$comunidad->telefono:'' ) : old('telefono') }}">
    </div>
    <div >
        <label for="celular" class="label">Celular</label>
        <input type="number" class="input" name="celular" 
        value="{{ old('celular')==null ? ( isset($comunidad)?$comunidad->celular:'' ) : old('celular') }}">
    </div>
    {{-- checkbox para saber si esta activo --}}
    <div >
        <input class="form-check-input" type="checkbox" name="activo" id="activo" 
        {{ old('activo')==null 
            ? ( isset($comunidad) && $comunidad->activo==0 ? '' : 'checked' ) 
            : ( old('activo')==1 ? 'checked' : '' ) }}>
        <label class="label" for="activo">
            Activo
        </label>

    </div>
    <div class="d-grid gap-2 py-2">
    <button type="submit" class="btn btn-primary">Guardar</button>
    <input type="hidden" name="id" id="id_comunidad_eliminar" required>
    <button type="submit" class="btn btn-danger" id="btn_eliminar_comunidad">Cerrar</button>
               
    </div>
</form>


@endsection