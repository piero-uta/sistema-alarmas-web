@extends('layouts.app')
@section('title', 'AsignacionPerfiles')

@section('content')
    <h2>Asignacion de Perfiles</h2>
    @include('includes.alerts')
    {{-- <div>{{ json_encode($permisos) }}</div> --}}
    <hr>
    <label>selección Perfiles: </label>
    <select id="redireccionarSelect">
        @foreach ($perfiles_comunidad as $perfil_comunidad)
            <option value={{ $perfil_comunidad->id }} @if ($perfil_comunidad->id == $perfil_aux) selected @endif>
                {{ $perfil_comunidad->nombre }}</option>
        @endforeach
    </select>
    <hr>

    <div class="table-responsive">
        {{-- <b>{{ json_encode($todasLasOpciones) }}</b> --}}
        <table id="myTable" class="display" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th scope="col">
                        #
                    </th>
                    <th scope="col">
                        Menú
                    </th>
                    <th scope="col">
                        Acciones
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($todasLasOpciones as $permiso)
                    <tr>
                        <th scope="row">
                        </th>
                        <td>
                            {{ $permiso['opcion'] }}
                        </td>
                        <td >
                            @php
                                $array = explode('-', $permiso['acciones_concatenadas']);
                            @endphp
                            @foreach (['c' => 'Crear', 'r' => 'Leer', 'u' => 'Actualizar', 'd' => 'Eliminar'] as $letter => $action)
                                @if (in_array($letter, $array))
                                    {{-- {{ $action }} está en el array --}}
                                    <input type="checkbox" class="checkbox-perfiles "
                                        name="{{ $perfil_aux . '-' . $permiso['opcion'] . '-' . $letter }}"
                                        value="{{ $letter }}" checked style="background: #509fd8;">
                                @else
                                    {{-- {{ $action }} no está en el array --}}
                                    <input type="checkbox" class="checkbox-perfiles"
                                        name="{{ $perfil_aux . '-' . $permiso['opcion'] . '-' . $letter }}"
                                        value="{{ $letter }}"checked style="background: #509fd8;">
                                @endif
                                {{ $action }}
                            @endforeach
                        </td>
    </div>
    </tr>
    @endforeach
    </tbody>

    </table>
    </div>



    {{-- TO DO: confirmar eliminar --}}
    <div class="modal" tabindex="-1" id="modalUsuario">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>

                    <a type="button" class="btn" href="#" id="btn_editar_usuario" style="background: #509fd8;">Editar</a>

                    <form action="#" method="POST" id="form_eliminar_usuario">
                        @csrf
                        <input type="hidden" name="id" id="id_usuario_eliminar" required>
                        <button type="submit" class="btn btn-danger" id="btn_eliminar_usuario">Eliminar</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        var table = new DataTable('#myTable', {
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
            },
        });
    </script>
    <script type="text/javascript">
        // Obtén una referencia al elemento <select>
        var select = document.getElementById("redireccionarSelect");

        // Agrega un evento onchange al elemento <select>
        select.addEventListener("change", function() {
            // Obtiene el valor seleccionado
            var selectedValue = select.value;




            // Verifica que el valor no esté vacío
            if (selectedValue) {
                // Redirige a la URL seleccionada
                var url = `/asignacionPerfiles/${selectedValue}`;
                window.location.href = url;
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.checkbox-perfiles').change(function() {
                // Obtener el atributo "name" del checkbox
                var checkboxName = $(this).attr('name');

                // Hacer una solicitud AJAX cuando cambia el estado del checkbox
                var isChecked = $(this).is(':checked');
                $.ajax({
                    url: '{{ route('asignacionPerfiles.onCheckedPermiso') }}', // La URL de la ruta en Laravel
                    type: 'POST', // Puedes cambiar el método HTTP según tus necesidades
                    data: {
                        _token: '{{ csrf_token() }}', // Agregar el token CSRF
                        checkboxName: checkboxName, // Enviar el atributo "name" del checkbox
                        isChecked: isChecked, // Enviar el estado del checkbox (marcado o desmarcado)
                        // Otra información que desees enviar al controlador
                    },
                    success: function(response) {
                        console.log(response);
                        // Maneja la respuesta del controlador aquí
                    }
                });
            });
        });
    </script>
@endsection
