@extends('layouts.app')
@section('title', 'Guardar usuario')

@section('content')
    <h2>Crear usuario</h2>
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

        <div>
            <label class="label" for="password">Contraseña*</label>
            <div class="input-group">
                <input class="input form-control" type="password" name="password" id="password" placeholder="******" required autocomplete="new-password">
                <button class="hide-password" id="hide-password-new" type="button"><i class="fas fa-eye-slash"></i></button>
            </div>
        </div>
        <div>
            <label class="label" for="confirmar_password">Confirmar contraseña*</label>
            <div class="input-group">
                <input class="input form-control" type="password" name="password_confirmation" id="confirmar_password" placeholder="******" required autocomplete="off" title="La contraseña debe ser igual a la anterior.">
                <button class="hide-password" id="hide-password-confirmation" type="button"><i class="fas fa-eye-slash"></i></button>
            </div>
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

        <hr>

        <div class="input-group">
            <div class="input-group-prepend">
                <label class="input-group-text" for="perfil_id">Perfil</label>
            </div>
            <select class="custom-select" name="perfil_id">
                <option value="">Seleccionar</option>
                @foreach ($perfiles as $perfil)
                    <option value="{{ $perfil->id }}"
                        {{ old('perfil_id') == null
                            ? (isset($usuario) && $perfil_id == $perfil->id
                                ? 'selected'
                                : '')
                            : (old('perfil_id') == $perfil->id
                                ? 'selected'
                                : '') }}>
                        {{ $perfil->nombre }}
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
            <button type="submit" class="btn btn-primary" style="margin-right: 20px; background: #509fd8;">Guardar</button>
            <a class="btn btn-danger" href="javascript:history.back()">Cancelar</a>
        </div>
    </form>


@endsection
@section('scripts')
<script>
    // Password
    const password = document.getElementById('password');
    const passwordConfirmation = document.getElementById('confirmar_password');
    const hidePasswordNew = document.getElementById('hide-password-new');
    const hidePasswordConfirmation = document.getElementById('hide-password-confirmation');

    // Mostrar u ocultar contraseña
    hidePasswordNew.addEventListener('click', (e) => {
        if(password.type == 'password'){
            password.type = 'text';
            hidePasswordNew.innerHTML = '<i class="fas fa-eye"></i>';
        }else{
            password.type = 'password';
            hidePasswordNew.innerHTML = '<i class="fas fa-eye-slash"></i>';
        }
    });
    // Mostrar u ocultar confirmar contraseña
    hidePasswordConfirmation.addEventListener('click', (e) => {
        if(passwordConfirmation.type == 'password'){
            passwordConfirmation.type = 'text';
            hidePasswordConfirmation.innerHTML = '<i class="fas fa-eye"></i>';
        }else{
            passwordConfirmation.type = 'password';
            hidePasswordConfirmation.innerHTML = '<i class="fas fa-eye-slash"></i>';
        }
    });

    // Validar confirmar contraseña
    passwordConfirmation.addEventListener('input', (e) => {
        let passwordValue = password.value;
        let passwordConfirmationValue = e.target.value;
        if(passwordValue != passwordConfirmationValue){
            passwordConfirmation.setCustomValidity('La contraseña debe ser igual a la anterior.');
            // Quitar clase valid y agregar invalid
            passwordConfirmation.classList.remove('valid');
            passwordConfirmation.classList.add('invalid');
        }else{
            passwordConfirmation.setCustomValidity('');
            // Quitar clase invalid y agregar valid
            passwordConfirmation.classList.remove('invalid');
            passwordConfirmation.classList.add('valid');
        }
    });
</script>

@endsection
