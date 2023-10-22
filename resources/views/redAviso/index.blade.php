@extends('layouts.app')
@section('title', 'Red de Aviso')

@push('head-scripts')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCJNN-iTg6exmzgXLjB_4KNGY_869oNBGM&v=beta&libraries=marker&callback=initMap"></script>
@endpush

@section('content')

<h2>Red de aviso</h2>
{{-- seleccionar direccion --}}
<form method="GET" class="form form__container" action="{{ route('red-avisos.index') }}">
    <div class="form-group">
        <label for="direccion">Dirección</label>
        <select class="form-control" id="direccion" name="direccion_id">
            <option value="">Seleccionar</option>
            @foreach ($direcciones as $direccion)
            
                {{-- <option value="{{$direccion->id}}">{{$direccion->codigo}}</option> 
                    revisando $direccion_id para saber el valor que deberia estar seleccionado--}}
                <option value="{{$direccion->id}}" {{ old('direccion_id') == null
                    ? (isset($direccion_id) && $direccion_id == $direccion->id
                        ? 'selected'
                        : '')
                    : (old('direccion_id') == $direccion->id
                        ? 'selected'
                        : '') }}>{{$direccion->codigo}}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Seleccionar</button>

</form>

@if($redes->count() > 0)
    <div id="map" style="height: 400px; width: 100%; z-index: 0; margin: 3rem 0"></div>


    
    <table class="table">
        <thead>
            <tr>
                <th scope="col">
                    #
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
            @foreach ($redes as $red)
            @php($direccion_red = $direcciones->where('id', $red->direccion_vecino_id)->first())
            <tr>
                <th scope="row">
                    {{$red->id}}
                </th>
                <td>
                    {{-- direccion donde red->direccion_vecino_id --}}
                    {{$direccion_red->codigo}}
                </td>
                <td>
                    @if ($red->activo)
                        Activo
                    @else
                        Inactivo
                    @endif
                </td>
                <td>
                    <form method="GET" class="form form__container" action="{{ route('red-avisos.crearEditar') }}">
                        <input type="hidden" name="direccion_id" value="{{$direccion_id}}" required>
                        <input type="hidden" name="id" value="{{$red->id}}" required>
                        <button type="submit" class="btn btn-primary">Editar</button>
                    </form>
                    <form method="POST" action="{{route('red-avisos.eliminar')}}">
                        @csrf
                        <input type="hidden" name="direccion_id" value="{{$direccion_id}}" required>
                        <input type="hidden" name="id" value="{{$red->id}}" required>
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
    
@endif

@if($direccion_id != "")
    {{-- boton crear --}}
    <form method="GET" class="form form__container" action="{{ route('red-avisos.crearEditar') }}">
        <input type="hidden" name="direccion_id" value="{{$direccion_id}}" required>
        <button type="submit" class="btn btn-primary">Crear</button>
    </form>
@else
    <h3>Debes seleccionar una dirección</h3>
@endif
@endsection

@section('scripts')
<script>
    const direccion_id = <?php echo $direccion_id; ?>;
    const redes = <?php echo json_encode($redes); ?>;
    const direcciones = <?php echo json_encode($direcciones); ?>;
</script>
<script type="text/javascript" src="{{ asset('js/redAviso/indexMapa.js') }}"></script>
@endsection





