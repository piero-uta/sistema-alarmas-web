@extends('layouts.app')
@section('title', 'Direcciones')

@section('content')

<h2>Direcciones</h2>
<div class="table-responsive">
    <table id="myTable" class="display"  width="100%" cellspacing="0">
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
            <tr onClick="modalDireccion({{$direccion}})">
                <th scope="row">
                    {{$direccion->id}}
                </th>
                <td>
                    {{$direccion->rut}} - {{$direccion->digito}}
                </td>
                <td>
                    {{$direccion->calle}}
                </td>
                <td>
                    {{$direccion->numero}}
                </td>
                <td>
                    {{$direccion->representante}}
                </td>
                <td>
                    {{$direccion->codigo}}
                </td>
                <td>
                    <a type="button" class="btn btn-primary" href="{{route('direcciones.crearEditar', ['id' => $direccion->id])}}">Editar</a>
                    {{-- eliminar --}}
                    <form method="POST" action="{{route('direcciones.eliminar')}}">
                        @csrf
                        <input type="hidden" name="id" value="{{$direccion->id}}">
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>

            </tr>
                
                
            @endforeach

        </tbody>
    </table>
    <div class="d-flex justify-content-end py-2">
        <a type="button" class="btn btn-primary" href="{{route('direcciones.crearEditar')}}">Crear</a>
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
@endsection
@endsection





