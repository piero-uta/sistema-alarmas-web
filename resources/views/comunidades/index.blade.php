@extends('layouts.app')
@section('title', 'Comunidades')

@section('content')

<h2>Comunidades</h2>
<div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">
                    #
                </th>
                <th scope="col">
                    Rut
                </th>
                <th scope="col">
                    Razon social
                </th>
                <th scope="col">
                    Dirección
                </th>
                <th scope="col">
                    Tipo servicio
                </th>
                <th scope="col">
                    Costo mensual
                </th>
                <th scope="col">
                    Estado
                </th>
            </tr>            
        </thead>
        <tbody>
            @foreach ($comunidades as $comunidad)
            <tr onClick="modalComunidad({{$comunidad}})">
                <th scope="row">
                    {{$comunidad->id}}
                </th>
                <td>
                    {{$comunidad->rut}}-{{$comunidad->digito}}
                </td>
                <td>
                    {{$comunidad->razon_social}}
                </td>
                <td>
                    {{$comunidad->direccion}}
                </td>
                <td>
                    {{$comunidad->tipo_servicio}}
                </td>
                <td>
                    {{$comunidad->costo_mensual}}
                </td>
                <td>
                    @if ($comunidad->activo)
                        Activo
                    @else
                        Inactivo
                    @endif
                </td>
            </tr>
                
                
            @endforeach

        </tbody>

    </table>
</div>



<a type="button" class="btn btn-primary" href="{{route('comunidades.crearEditar')}}">Crear</a>

<div class="modal" tabindex="-1" id="modalComunidad">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Comunidad</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">            
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                {{-- editar --}}
                <a type="button" class="btn btn-primary" href="#" id="btn_editar_comunidad">Editar</a>
                {{-- eliminar form--}}
                <form action="#" method="POST" id="form_eliminar_comunidad">
                    @csrf
                    <input type="hidden" name="id" id="id_comunidad_eliminar" required>
                    <button type="submit" class="btn btn-danger" id="btn_eliminar_comunidad">Eliminar</button>
                </form>
                
            </div>
        </div>
    </div>
</div>



@endsection

@section('scripts')
<script>
    function modalComunidad(comunidad){
        const modal = new bootstrap.Modal(document.getElementById('modalComunidad'));
        modal.show();
        document.getElementById('modalComunidad').querySelector('.modal-body').innerHTML = `
            <p><strong>Rut:</strong> ${comunidad.rut}-${comunidad.digito}</p>
            <p><strong>Estado:</strong> ${comunidad.activo ? 'Activo' : 'Inactivo'}</p>
            <p><strong>Razon social:</strong> ${comunidad.razon_social?comunidad.razon_social:''}</p>
            <p><strong>Representante legal:</strong> ${comunidad.representante_legal?comunidad.representante_legal:''}</p>
            <p><strong>Email:</strong> ${comunidad.email?comunidad.email:''}</p>
            <p><strong>Dirección:</strong> ${comunidad.direccion?comunidad.direccion:''}</p>
            <p><strong>Giro:</strong> ${comunidad.giro?comunidad.giro:''}</p>
            <p><strong>Tipo servicio:</strong> ${comunidad.tipo_servicio?comunidad.tipo_servicio:''}</p>
            <p><strong>Costo mensual:</strong> ${comunidad.costo_mensual?comunidad.costo_mensual:''}</p>
            <p><strong>Telefono:</strong> ${comunidad.telefono?comunidad.telefono:''}</p>
            <p><strong>Celular:</strong> ${comunidad.celular?comunidad.celular:''}</p>

            
            
        `;
        document.getElementById('btn_editar_comunidad').href = "{{route('comunidades.crearEditar')}}?id="+comunidad.id;
        
        document.getElementById('form_eliminar_comunidad').action = "{{route('comunidades.eliminar')}}";
        document.getElementById('id_comunidad_eliminar').value = comunidad.id;

    }
</script>