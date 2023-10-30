@extends('layouts.app')
@section('title', 'Guardar comunidad')

@section('content')
<h1 >Crear comunidad</h1>

<form method="POST"  action="{{route('comunidades.handleGuardar')}}">
    @csrf
    @if(isset($comunidad))
        <input type="hidden" name="id" value="{{$comunidad->id}}">
    @endif

    <div class="form-group">
        <label for="rut" class="label">Rut*</label>
        <input type="number" class="form-control" name="rut" required
        value="{{ old('rut')==null ? ( isset($comunidad)?$comunidad->rut:'' ) : old('rut') }}">
    </div>
    <div class="form-group">
        <label for="digito" class="label">Digito*</label>
        <input type="text" class="form-control" name="digito"required
        value="{{ old('digito')==null ? ( isset($comunidad)?$comunidad->digito:'' ) : old('digito') }}">
    </div>
    <div class="form-group">
        <label for="razon_social" class="label">Razon social*</label>
        <input type="text" class="form-control" name="razon_social" required
        value="{{ old('razon_social')==null ? ( isset($comunidad)?$comunidad->razon_social:'' ) : old('razon_social') }}">
    </div>
    <div class="form-group">
        <label for="representante_legal" class="label">Representante legal</label>
        <input type="text" class="form-control" name="representante_legal" 
        value="{{ old('representante_legal')==null ? ( isset($comunidad)?$comunidad->representante_legal:'' ) : old('representante_legal') }}">
    </div>
    <div class="form-group">
        <label for="email" class="label">Email</label>
        <input type="email" class="form-control" name="email"
        value="{{ old('email')==null ? ( isset($comunidad)?$comunidad->email:'' ) : old('email') }}">
    </div>
    <div class="form-group">
        <label for="direccion" class="label">Dirección*</label>
        <input type="text" class="form-control" name="direccion" required
        value="{{ old('direccion')==null ? ( isset($comunidad)?$comunidad->direccion:'' ) : old('direccion') }}">
    </div>
    <div class="form-group">
        <label for="giro" class="label">Giro</label>
        <input type="text" class="form-control" name="giro" 
        value="{{ old('giro')==null ? ( isset($comunidad)?$comunidad->giro:'' ) : old('giro') }}">
    <div class="form-group">
        <label for="tipo_servicio" class="label">Tipo servicio*</label>
        <input type="text" class="form-control" name="tipo_servicio" required
        value="{{ old('tipo_servicio')==null ? ( isset($comunidad)?$comunidad->tipo_servicio:'' ) : old('tipo_servicio') }}">
    </div>
    <div class="form-group">
        <label for="costo_mensual" class="label">Costo mensual*</label>
        <input type="number" class="form-control" name="costo_mensual" required
        value="{{ old('costo_mensual')==null ? ( isset($comunidad)?$comunidad->costo_mensual:'' ) : old('costo_mensual') }}">
    </div>
    <div class="form-group">
        <label for="telefono" class="label">Telefono</label>
        <input type="number" class="form-control" name="telefono" 
        value="{{ old('telefono')==null ? ( isset($comunidad)?$comunidad->telefono:'' ) : old('telefono') }}">
    </div>
    <div class="form-group">
        <label for="celular" class="label">Celular</label>
        <input type="number" class="form-control" name="celular" 
        value="{{ old('celular')==null ? ( isset($comunidad)?$comunidad->celular:'' ) : old('celular') }}">
    </div>
    {{-- checkbox para saber si esta activo --}}
    <div class="checkbox">
        <input class="checkbox" type="checkbox" name="activo" id="activo" 
        {{ old('activo')==null 
            ? ( isset($comunidad) && $comunidad->activo==0 ? '' : 'checked' ) 
            : ( old('activo')==1 ? 'checked' : '' ) }}>
        <label class="label" for="activo">
            Activo
        </label>

    </div>

    <div class="d-flex justify-content-end py-2">
        <button type="submit" class="btn btn-primary" style="margin-right: 20px;">Guardar</button>
        <input type="hidden" name="id" id="id_comunidad_eliminar" required>
        <button type="submit" class="btn btn-danger data-dismiss="modal" id="btn_eliminar_comunidad">Cancelar</button>
                
    </div>
</form>


@endsection