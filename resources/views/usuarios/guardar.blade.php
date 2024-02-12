@extends('layouts.app')
@section('title', 'Guardar usuario')

@section('content')
    <h2>Crear usuario</h2>

<div class="container">    
    <h1 class="heading">Crear empleado</h1>
    {{-- Boton buscar empleado --}}
    <div class="form__container">
        <button class="btn btn-primary"
        data-bs-toggle="modal" data-bs-target="#modalBuscarPersonas" style="background: #509fd8;"
        >Buscar usuario existente</button>
    </div>

    <form method="POST" action="{{ route('usuarios.handleGuardar') }}">
        @csrf
        @if (isset($usuario))
            <input type="hidden" name="id" value="{{ $usuario->id }}">
        @endif

        <div class="form-group">
            <label for="nombre" class="label">Nombre*</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required
                value="{{ old('nombre') == null ? (isset($usuario) ? $usuario->nombre : '') : old('name') }}">
        </div>
        <div class="form-group">
            <label for="apellido_paterno" class="label">Apellido paterno*</label>
            <input type="text" class="form-control" id="apellido_paterno"name="apellido_paterno" required
                value="{{ old('apellido_paterno') == null ? (isset($usuario) ? $usuario->apellido_paterno : '') : old('apellido_paterno') }}">
        </div>
        <div class="form-group">
            <label for="apellido_materno" class="label">Apellido materno</label>
            <input type="text" class="form-control" id="apellido_materno" name="apellido_materno"
                value="{{ old('apellido_materno') == null ? (isset($usuario) ? $usuario->apellido_materno : '') : old('apellido_materno') }}">
        </div>
        <div class="form-group">
            <label for="email" class="label">Email*</label>
            <input type="email" class="form-control" id="email" name="email" required
                value="{{ old('email') == null ? (isset($usuario) ? $usuario->email : '') : old('email') }}">
                @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </ul>
    </div>
@endif

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



<!-- Modal buscar usuarios -->
<div class="modal fade" id="modalBuscarPersonas" tabindex="-1" aria-labelledby="modalBuscarPersonasLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalBuscarPersonasLabel">Buscar personas</h5>
                <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close" style="background-color: transparent; border: none; padding: 0.375rem 0.75rem; font-size: 1rem; line-height: 1.5; border-radius: 0.35rem;" onmouseover="changeColor(this)" onmouseout="restoreColor(this)">
                    <span aria-hidden="true" style="color: black; font-size: 24px;">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="searchForm">
                    <div class="mb-3">
                        <label for="searchQuery" class="form-label">Buscar persona por nombre, apellidos o correo electrónico</label>
                        <input type="text" class="form-control" id="searchQuery" placeholder="Escribe aquí">
                    </div>
                </form>
                <div id="personas-container">
                    <!-- Aquí se mostrarán los resultados de la búsqueda -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script para cambiar el color al pasar el ratón sobre el botón de cierre (X) -->
<script>
    // Función para cambiar el color al pasar el ratón sobre el botón de cierre (X)
    function changeColor(element) {
        element.style.backgroundColor = "#e74a3b"; // Cambiar el color de fondo a rojo al pasar el ratón
        element.querySelector('span').style.color = "white"; // Cambiar el color del texto a blanco al pasar el ratón
    }

    // Función para restaurar el color original al dejar de pasar el ratón sobre el botón de cierre (X)
    function restoreColor(element) {
        element.style.backgroundColor = ""; // Restaurar el color de fondo original al dejar de pasar el ratón
        element.querySelector('span').style.color = "black"; // Restaurar el color del texto original al dejar de pasar el ratón
    }
</script>

@endsection


{{-- scripts --}}

@section('scripts')

    <script type="module" src="{{ asset('js/usuario/buscadorUsuario.js') }}"></script>
    <script>
        const form = document.getElementById('form_empleado');
        console.log('form',form);
        // Form no se envia si se apreta enter
        form.addEventListener('keypress', (e) => {
            if(e.key == "Enter"){
                e.preventDefault();
            }
        });
    
    </script>
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
