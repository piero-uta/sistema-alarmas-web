@extends('layouts.app')
@section('title', 'Usuarios')

@section('content')

    <h2>Usuarios</h2>
    {{-- <div>{{ json_encode($permisos) }}</div> --}}

    <div class="table-responsive">
        <table id="myTable" class="display" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th scope="col">
                        #
                    </th>
                    <th scope="col">
                        Nombre
                    </th>
                    <th scope="col">
                        Apellidos
                    </th>
                    <th scope="col">
                        Email
                    </th>
                    <th scope="col">
                        Perfil
                    </th>
                    <th scope="col">
                        Estado
                    </th>
                    <th scope="col">
                        Acciones
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usuarios as $usuario)
                    <tr>
                        <th scope="row">
                            {{ $usuario->id }}
                        </th>
                        <td>
                            {{ $usuario->nombre }}
                        </td>
                        <td>
                            {{ $usuario->apellido_paterno }} {{ $usuario->apellido_materno }}
                        </td>
                        <td>
                            {{ $usuario->email }}
                        </td>
                        <td>
                            @php
                                $colorHexadecimal = substr(md5($usuario->perfil), 0, 3);
                                [$r, $g, $b] = sscanf($colorHexadecimal, '%02x%02x%02x');
                                // Calculamos la luminancia del color de fondo
                                $luminancia = (0.299 * $r + 0.587 * $g + 0.114 * $b) / 255;

                                // Determinamos si el texto debe ser oscuro o claro
                                $colorTexto = $luminancia > 0.5 ? '#000000' : '#FFFFFF';
                            @endphp
                            <style>
                                .badge-color-{{ $colorHexadecimal }} {
                                    border: 2px solid #{{ $colorHexadecimal }};
                                    color: #000;

                                }
                            </style>
                            <h4><span class="badge badge-color-{{ $colorHexadecimal }}">{{ $usuario->perfil }}</span>
                                <h4>

                                    {{-- {{ $usuario->perfil }} --}}


                        </td>
                        <td>
                            @if ($usuario->activo)
                                Activo
                            @else
                                Inactivo
                            @endif
                        </td>
                        <td>
                            <div class="d-flex">
                                {{-- ver --}}
                                @if (in_array('Usuarios-r', $permisos))
                                    <button type="button" class="btn btn-primary" style="margin-right: 20px;"
                                        onClick="modalUsuario({{ $usuario }})">Ver</button>
                                @endif
                                {{-- editar --}}
                                @if (in_array('Usuarios-u', $permisos))
                                    <a type="button" class="btn btn-primary" style="margin-right: 20px;"
                                        href="{{ route('usuarios.crearEditar') }}?id={{ $usuario->id }}">Editar</a>
                                @endif
                                {{-- eliminar --}}
                                @if (in_array('Usuarios-d', $permisos))
                                    <form method="POST" action="{{ route('usuarios.eliminar') }}">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $usuario->id }}">
                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                    </form>
                                @endif
                        </td>
    </div>
    </tr>
    @endforeach

    </tbody>

    </table>
    </div>
    @if (in_array('Usuarios-c', $permisos))
        <div class="d-flex justify-content-end py-2">
            <a type="button" class="btn btn-primary" href="{{ route('usuarios.crearEditar') }}">Crear</a>
        </div>
    @endif




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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

                    

                </div>
            </div>
        </div>
    </div>


@endsection

@section('scripts')
    <script>
        function modalUsuario(usuario) {
            console.log(usuario)

            const modal = new bootstrap.Modal(document.getElementById('modalUsuario'));
            modal.show();
            document.getElementById('modalUsuario').querySelector('.modal-body').innerHTML = `
        <p><strong>Nombre:</strong> ${usuario.nombre}</p>
        <p><strong>Apellido paterno:</strong> ${usuario.apellido_paterno}</p>
        <p><strong>Apellido materno:</strong> ${usuario.apellido_materno}</p>
        <p><strong>Email:</strong> ${usuario.email}</p>
        <p><strong>Estado:</strong> ${usuario.activo ? 'Activo' : 'Inactivo'}</p>
        `;
            document.getElementById('btn_editar_usuario').href = "{{ route('usuarios.crearEditar') }}?id=" + usuario.id;

            document.getElementById('form_eliminar_usuario').action = "{{ route('usuarios.eliminar') }}";
            document.getElementById('id_usuario_eliminar').value = usuario.id;

        }
    </script>

    <script>
        var table = new DataTable('#myTable', {
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
            },
        });
    </script>
@endsection
