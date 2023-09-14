@extends('layouts.app')
@section('title', 'Usuarios')

@section('content')

<h2>Usuarios</h2>
<div>
    <table class="table">
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
                    Estado
                </th>
            </tr>            
        </thead>
        <tbody>
            @foreach ($usuarios as $usuario)
            <tr onClick="modalComunidad({{$usuario}})">
                <th scope="row">
                    {{$usuario->id}}
                </th>
                <td>
                    {{$usuario->name}}
                </td>
                <td>
                    {{$usuario->apellido_paterno}} {{$usuario->apellido_materno}}
                </td>
                <td>
                    {{$usuario->email}}
                </td>
                <td>
                    @if ($usuario->activo)
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

<a type="button" class="btn btn-primary" href="{{route('usuarios.crearEditar')}}">Crear</a>



@endsection