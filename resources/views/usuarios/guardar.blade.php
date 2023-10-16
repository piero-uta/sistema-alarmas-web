@extends('layouts.app')
@section('title', 'Guardar usuario')

@section('content')
    <h2 class="login-page-new__main-form-title">Crear usuario</h2>
    <form method="POST" class="form form__container" action="{{ route('usuarios.handleGuardar') }}">
        @csrf
        @if (isset($usuario))
            <input type="hidden" name="id" value="{{ $usuario->id }}">
        @endif

        <div >
            <label for="nombre" class="label">Nombre*</label>
            <input type="text" class="input" name="nombre" required
                value="{{ old('nombre') == null ? (isset($usuario) ? $usuario->nombre : '') : old('name') }}">
        </div>
        <div >
            <label for="apellido_paterno" class="label">Apellido paterno*</label>
            <input type="text" class="input" name="apellido_paterno" required
                value="{{ old('apellido_paterno') == null ? (isset($usuario) ? $usuario->apellido_paterno : '') : old('apellido_paterno') }}">
        </div>
        <div >
            <label for="apellido_materno" class="label">Apellido materno</label>
            <input type="text" class="input" name="apellido_materno"
                value="{{ old('apellido_materno') == null ? (isset($usuario) ? $usuario->apellido_materno : '') : old('apellido_materno') }}">
        </div>
        <div >
            <label for="email" class="label">Email*</label>
            <input type="email" class="input" name="email" required
                value="{{ old('email') == null ? (isset($usuario) ? $usuario->email : '') : old('email') }}">
        </div>
        <div>
            <label for="password" class="label">Password*</label>
            <input type="password" class="input" name="password" required>
        </div>

        {{-- seleccionar direccion --}}
        <div>
            <label for="direccion_id" class="form-label">Direccion</label>
            <select class="select" name="direccion_id">
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

        {{-- checkbox para saber si esta activo --}}
        <div>
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



        <div class="d-flex justify-content-end py-2">
            <button type="submit" class="btn btn-primary" style="margin-right: 20px;">Guardar</button>
            <button type="submit" class="btn btn-danger data-dismiss=">Cancelar</button>
        </div>
    </form>


@endsection
