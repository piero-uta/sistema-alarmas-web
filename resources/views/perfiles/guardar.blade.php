@extends('layouts.app')
@section('title', 'Guardar perfil')

@section('content')
    <h2>Crear Perfil</h2>
    <form method="POST" action="{{ route('perfiles.handleGuardar') }}">
        @csrf
        @if (isset($perfil))
            <input type="hidden" name="id" value="{{ $perfil->id }}">
        @endif
        <div class="form-group">
            <label for="nombre" class="label">Nombre</label>
            <input type="text" class="form-control" name="nombre" required
                value="{{ old('nombre') == null ? (isset($perfil) ? $perfil->nombre : '') : old('name') }}">
        </div>
        <div class="form-group">
            <label for="descripcion" class="label">Descripcion</label>
            <input type="text" class="form-control" name="descripcion" required
                value="{{ old('descripcion') == null ? (isset($perfil) ? $perfil->descripcion : '') : old('descripcion') }}">
        </div>
        <hr>
        <div class="form-check py-2">
            <input class="form-check-input" type="checkbox" name="activo" id="activo"
                {{ old('activo') == null
                    ? (isset($perfil) && $perfil->activo == 0
                        ? ''
                        : 'checked')
                    : (old('activo') == 1
                        ? 'checked'
                        : '') }}>

            <label class="form-check-label" for="flexCheckDefault">
                Activo
            </label>
        </div>


        <div class="d-flex justify-content-end py-2">
            <button type="submit" class="btn btn-primary" style="margin-right: 20px;">Guardar</button>
            <a class="btn btn-danger" href="javascript:history.back()">Cancelar</a>
        </div>
    </form>


@endsection
