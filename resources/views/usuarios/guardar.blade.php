@extends('layouts.app')
@section('title', 'Guardar usuario')

@section('content')
    <h2 >Crear usuario</h2>
    <form method="POST" action="{{ route('usuarios.handleGuardar') }}">
        @csrf
        @if (isset($usuario))
            <input type="hidden" name="id" value="{{ $usuario->id }}">
        @endif

        <div class="form-group">
            <label for="nombre" class="label">Nombre*</label>
            <input type="text" class="form-control" name="nombre" required
                value="{{ old('nombre') == null ? (isset($usuario) ? $usuario->nombre : '') : old('name') }}">
        </div>
        <div class="form-group">
            <label for="apellido_paterno" class="label">Apellido paterno*</label>
            <input type="text" class="form-control" name="apellido_paterno" required
                value="{{ old('apellido_paterno') == null ? (isset($usuario) ? $usuario->apellido_paterno : '') : old('apellido_paterno') }}">
        </div>
        <div class="form-group">
            <label for="apellido_materno" class="label">Apellido materno</label>
            <input type="text" class="form-control" name="apellido_materno"
                value="{{ old('apellido_materno') == null ? (isset($usuario) ? $usuario->apellido_materno : '') : old('apellido_materno') }}">
        </div>
        <div class="form-group">
            <label for="email" class="label">Email*</label>
            <input type="email" class="form-control" name="email" required
                value="{{ old('email') == null ? (isset($usuario) ? $usuario->email : '') : old('email') }}">
        </div>
        <div class="form-group">
            <label for="password" class="label">Password*</label>
            <input type="password" class="form-control" name="password" required>
        </div>

        {{-- seleccionar direccion --}}
        <div class="input-group">
            <div class="input-group-prepend">
                <label class="input-group-text" for="direccion_id">Direccion</label>
            </div>
            <select class="custom-select" name="direccion_id">
                <option value="">Seleccionar</option>
                @foreach ($direcciones as $direccion)
                    <option value="{{ $direccion->id }}"
                        {{ old('direccion_id') == null
                            ? (isset($usuario) && $direccion_id == $direccion->id
                                ? 'selected'
                                : '')
                            : (old('direccion_id') == $direccion->id
                                ? 'selected'
                                : '') }}>
                        {{ $direccion->calle }} {{ $direccion->numero }} {{ $direccion->piso }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-check py-2">
           <input class="form-check-input" type="checkbox" name="activo" id="activo"
                        {{ old('activo') == null
                            ? (isset($usuario) && $usuario->activo == 0
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
            <button class="btn btn-danger data-dismiss=">Cancelar</button>
        </div>
    </form>


@endsection

