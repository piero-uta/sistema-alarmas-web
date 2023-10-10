@extends('layouts.app')
@section('title', 'Red de Aviso')

@section('content')

<h2>Red de aviso</h2>
<div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">
                    #
                </th>
                <th scope="col">
                    id
                </th>
                <th scope="col">
                    Código de dirección aviso
                </th>
                <th scope="col">
                    Activo
                </th>
                <th scope="col">
                    Acción
                </th>
            </tr>            
        </thead>
        <tbody>
            {{--@foreach ($direcciones as $direccion)--}}

            <tr>
                <th scope="row">
                    id
                </th>
                <td>
                    ro-1
                </td>
                <td>
                    true
                </td>
                <td>
                    <a type="button" class="btn btn-primary" >Editar</a>
                    <form method="POST">
                        @csrf
                        <input type="hidden" name="id">
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>

            </tr>
            {{--@endforeach--}}
        </tbody>
    </table>
</div>

@endsection





