@extends('layouts.app')
@section('title', 'Usuarios')

@section('content')

<div>
    @if($comunidades)
        @foreach ($comunidades as $comunidad)
            <div>
                {{-- /comunidades/seleccionar/{comunidad_id} --}}
                <a href="{{ route('comunidades.seleccionar', ['comunidad_id' => $comunidad->id]) }}">
                    {{ $comunidad->razon_social }}
            </div>
        @endforeach
    @else
        <div>
            No hay comunidades
        </div>  
    @endif 

    {{-- @if(session('comunidad_id'))
        <div>
            Comunidad seleccionada: {{ session('comunidad_id') }}
        </div>
    @endif --}}
    
</div>
@endsection
