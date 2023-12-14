@extends('layouts.app')
@section('title', 'Perfiles')

@section('content')
    <h2>Perfiles</h2>
    {{-- <div>{{ json_encode($permisos) }}</div> --}}

    <div class="table-responsive">
        <table id="myTable" class="display" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th scope="col">
                        #
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
                @foreach ($perfiles as $perfil)
                    <tr>
                        <th scope="row">
                            {{ $perfil->id }}
                        </th>
                        <td>
                            {{ $perfil->nombre }}
                        </td>
                        <td>
                            @if ($perfil->activo)
                                Activo
                            @else
                                Inactivo
                            @endif
                        </td>
                        <td>
                        <div class="d-flex">
                            {{-- editar --}}
                            @if (in_array('Perfiles-u', $permisos))
                                <a href="{{ route('perfiles.crearEditar') }}?id={{ $perfil->id }}" type="button"style="margin-right: 20px;"
                                    class="btn btn-primary">
                                    <i class="fas fa-edit"></i> 
                                </a>
                            @endif
                            {{-- eliminar --}}
                            @if (in_array('Perfiles-d', $permisos))
                                <form method="POST" action="{{ route('perfiles.eliminar') }}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $perfil->id }}">
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-trash-alt"></i> 
                                    </button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
    @endforeach

    </tbody>

    </table>
    </div>
    @if (in_array('Perfiles-c', $permisos))
        <div class="d-flex justify-content-end py-2">
            <a href="{{ route('perfiles.crearEditar') }}" type="button" class="btn btn-primary">Crear</a>
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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>

                    <a type="button" class="btn btn-primary" href="#" id="btn_editar_usuario">Editar</a>

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
    {{-- <script>
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
    </script> --}}

    <script>
        var table = new DataTable('#myTable', {
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
            },
        });
    </script>
@endsection
