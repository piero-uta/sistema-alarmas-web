@extends('layouts.app')
@section('title', 'Guardar red de aviso')

@section('content')
    <h2>Crear red de aviso para {{$direccionSeleccionada->codigo}}</h2>
    <form method="POST" class="form form__container" action="{{ route('red-avisos.handleGuardar') }}">
        @csrf
        @if (isset($red))
            <input type="hidden" name="id" value="{{ $red->id }}">
        @endif

        <input type="hidden" name="direccion_id" value="{{ $direccionSeleccionada->id }}">

        <div class="form-group">
            <label for="direccion">Dirección del vecino</label>
            <select class="form-control" id="direccion" name="direccion_vecino_id">
                <option value="">Seleccionar</option>
                @foreach ($direcciones as $direccion)
                    <option value="{{$direccion->id}}" {{ old('direccion_vecino_id') == null
                        ? (isset($red) && $red->direccion_vecino_id == $direccion->id
                            ? 'selected'
                            : '')
                        : (old('direccion_vecino_id') == $direccion->id
                            ? 'selected'
                            : '') }}>{{$direccion->codigo}}</option>
                @endforeach
            </select>
        </div>
        {{-- checkbox para saber si esta activo --}}
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="activo" id="activo" 
                {{ old('activo') == null
                    ? (isset($usuario) && $usuario->activo == 0
                        ? ''
                        : 'checked')
                    : (old('activo') == 1
                        ? 'checked'
                        : '') }}>
            <label class="form-check-label" for="activo">
                Activo
            </label>

        </div>



        <div class="d-grid gap-2 py-2">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a class="btn btn-primary" href="/red-avisos">Cancelar</a>
        </div>
    </form>
@endsection