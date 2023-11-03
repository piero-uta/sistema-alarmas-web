@extends('layouts.app')
@section('title', '$chequeos')

@section('content')

<h2>chequeos</h2>
<div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">
                    #
                </th>
                <th scope="col">
                    Codigo Alarma
                </th>
                <th scope="col">
                    Fecha
                </th>
                <th scope="col">
                    Hora
                </th>
                <th scope="col">
                    Usuario
                </th>
                <th scope="col">
                    Estado
                </th>
                <th scope="col">
                    Vecino
                </th>
                <th scope="col">
                    Observacion
                </th>
                <th scope="col">
                    Tipo
                </th>
                <th scope="col">
                    Evento
                </th>
                <th scope="col">
                    Acciones
                </th>
            </tr>            
        </thead>
        <tbody>
            @foreach ($chequeos as $chequeo)
            <tr>
                <th scope="row">
                    {{$chequeo->id}}
                </th>
                <td>
                    {{$chequeo->codigo}}
                </td>
                <td>
                    {{$chequeo->fecha}}
                </td>
                <td>
                    {{$chequeo->hora}}
                </td>
                <td>
                    {{$chequeo->usuario_chequeo}}
                </td>
                <td>
                    {{$chequeo->estado_chequeo}}
                </td>
                <td>
                    {{$chequeo->vecino_chequeo}}
                </td>
                <td>
                    {{$chequeo->observacion}}
                </td>
                <td>
                    {{$chequeo->tipo_chequeo}}
                </td>
                <td>
                    {{$chequeo->tipo_evento}}
                </td>
                <td>
                    <a type="button" class="btn btn-primary" href="{{route('chequeos.crearEditar', ['id' => $chequeo->id])}}">Editar</a>
                    {{-- eliminar --}}
                    <form method="POST" action="{{route('chequeos.eliminar')}}">
                        @csrf
                        <input type="hidden" name="id" value="{{$chequeo->id}}">
                        <button type="submit" class="btn
                        btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection