@extends('layouts.app')
@section('title', 'Direcciones')

@section('content')

    <h2>Direcciones</h2>
    {{-- <div>{{ json_encode($permisos) }}</div> --}}

    <div class="table-responsive">
        <table id="myTable" class="display" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th scope="col">
                        #
                    </th>
                    <th scope="col">
                        Rut
                    </th>
                    <th scope="col">
                        Calle
                    </th>
                    <th scope="col">
                        Numero
                    </th>
                    <th scope="col">
                        Representante
                    </th>
                    <th scope="col">
                        Codigo
                    </th>
                    <th scope="col">
                        Acciones
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($direcciones as $direccion)
                    {{-- <tr onClick="modalDireccion({{ $direccion }})"> --}}
                    <tr>
                        <th scope="row">
                            {{ $direccion->id }}
                        </th>
                        <td>
                            {{ $direccion->rut }} - {{ $direccion->digito }}
                        </td>
                        <td>
                            {{ $direccion->calle }}
                        </td>
                        <td>
                            {{ $direccion->numero }}
                        </td>
                        <td>
                            {{ $direccion->representante }}
                        </td>
                        <td>
                            {{ $direccion->codigo }}
                        </td>
                        <td>
                            {{-- modal ver usuarios de la direccion, llamar a funcion --}}
                            <button type="button" class="btn btn-primary" onclick="modalUsuariosDireccion({{ $direccion }})">
                                Ver Usuarios
                            </button>
                            @if (in_array('DireccionesUsuario-u', $permisos))
                                <a type="button" class="btn btn-primary" style="margin-right: 20px;"
                                    href="{{ route('direcciones.crearEditar', ['id' => $direccion->id]) }}">Editar</a>
                            @endif
                            {{-- eliminar --}}
                            @if (in_array('DireccionesUsuario-d', $permisos))
                                <form method="POST" action="{{ route('direcciones.eliminar') }}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $direccion->id }}">
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                            @endif
                        </td>

                    </tr>
                @endforeach

            </tbody>

        </table>
        @if (in_array('DireccionesUsuario-c', $permisos))
            <div class="d-flex justify-content-end py-2">
                <a type="button" class="btn btn-primary" href="{{ route('direcciones.crearEditar') }}">Crear</a>
            </div>
        @endif
    </div>

    {{-- modalUsuariosDireccion --}}
    <div class="modal fade" id="modalUsuariosDireccion" tabindex="-1" aria-labelledby="modalUsuariosDireccionLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="modalUsuariosDireccionLabel" class="modal-title">Usuarios de la direccion</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                </div>
                <div id="modalUsuariosDireccionBody" class="modal-body">
                    Cargando...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

                </div>
            </div>
        </div>
    </div>
@section('scripts')
    <script>
        var table = new DataTable('#myTable', {
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
            },
        });
    </script>
    <script>
        function modalUsuariosDireccion(direccion) {
            var modal = new bootstrap.Modal(document.getElementById('modalUsuariosDireccion'), {
                keyboard: false
            })
            modal.show()
            document.getElementById('modalUsuariosDireccionLabel').innerHTML = 'Usuarios de la direccion ' + direccion.calle + ' ' + direccion.numero
            document.getElementById('modalUsuariosDireccionBody').innerHTML = 'Cargando...'
            fetch('{{ route('direcciones.usuarios') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        direccion_id: direccion.id
                    })
                })
                .then(response => response.text())
                .then(data => {
                    var response = JSON.parse(data)
                    var usuarios = response.usuarios
                    var html = ''
                    html += '<table class="table table-striped">'
                    html += '<thead>'
                    html += '<tr>'
                    html += '<th scope="col">#</th>'
                    html += '<th scope="col">Nombres</th>'
                    html += '<th scope="col">Apellidos</th>'
                    html += '</tr>'
                    html += '</thead>'
                    html += '<tbody>'
                    usuarios.forEach(usuario => {
                        html += '<tr>'
                        html += '<th scope="row">' + usuario.id + '</th>'
                        // html += '<td>' + usuario.nombre + ' ' + usuario.apellido_paterno +  ' ' + usuario.apellido_materno + '</td>'
                        html += '<td>' + usuario.nombre + '</td>'
                        html += '<td>' + usuario.apellido_paterno + ' ' + usuario.apellido_materno + '</td>'
                        html += '</tr>'
                    });
                    html += '</tbody>'
                    html += '</table>'
                    document.getElementById('modalUsuariosDireccionBody').innerHTML = html

                })
        }
    </script>
@endsection
@endsection
