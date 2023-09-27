@extends('layouts.app')
@section('title', 'Guardar dirección')

@section('content')
<h2  class="login-page-new__main-form-title">Crear dirección</h2>

<form method="POST" class="form form__container" action="{{route('direcciones.handleGuardar')}}">
    @csrf
    @if(isset($direccion))
        <input type="hidden" name="id" value="{{$direccion->id}}">
    @endif

    <div class="mb-3">
        <label for="rut" class="form-label">Rut*</label>
        <input type="text" class="form-control" name="rut" required
        value="{{ old('rut')==null ? ( isset($direccion)?$direccion->rut:'' ) : old('rut') }}">
    </div>
    <div class="mb-3">
        <label for="digito" class="form-label">Digito*</label>
        <input type="text" class="form-control" name="digito" required
        value="{{ old('digito')==null ? ( isset($direccion)?$direccion->digito:'' ) : old('digito') }}">
    </div>
    <div class="mb-3">
        <label for="calle" class="form-label">Calle*</label>
        <input type="text" class="form-control" name="calle" required
        value="{{ old('calle')==null ? ( isset($direccion)?$direccion->calle:'' ) : old('calle') }}">
    </div>
    <div class="mb-3">
        <label for="numero" class="form-label">Numero*</label>
        <input type="text" class="form-control" name="numero" required
        value="{{ old('numero')==null ? ( isset($direccion)?$direccion->numero:'' ) : old('numero') }}">
    </div>
    <div class="mb-3">
        <label for="representante" class="form-label">Representante*</label>
        <input type="text" class="form-control" name="representante" required
        value="{{ old('representante')==null ? ( isset($direccion)?$direccion->representante:'' ) : old('representante') }}">
    </div>

    <div class="d-grid gap-2 py-2">
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
</form>

<div id='map'>

</div>


@endsection

