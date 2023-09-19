@extends('layouts.app')
@section('title', 'Direcciones')

@section('content')

<h2>Direcciones</h2>
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
                    Digito
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
                    Comunidad
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
                    {{$direccion->rut}}
                </td>
                <td>
                    {{$direccion->digito}}
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
                    {{$direccion->comunidad->nombre}}
                </td>
            </tr>
                
                
            @endforeach

        </tbody>

    </table>
</div>

<a type="button" class="btn btn-primary" href="{{route('direcciones.crearEditar')}}">Crear</a>

@endsection





