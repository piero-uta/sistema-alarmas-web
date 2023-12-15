@extends('layouts.app')
@section('title', 'Guardar chequeo')

@section('content')




<div class="row">
    <div class="col-6">
        <h2 >Datos de la Alarma</h2>
        <div class="form-group">
            <label for="hora_alarma" class= "label">Hora</label>
            <input type="text" class="form-control" name="hora_alarma" 
            value="{{ old('hora_alarma')==null ? ( isset($chequeo)?$chequeo->hora_alarma:'' ) : old('hora_alarma') }}" readonly>
        </div>
        <div class="form-group">
            <label for="fecha_alarma" class= "label">Fecha</label>
            <input type="text" class="form-control" name="fecha_alarma" 
            value="{{ old('fecha_alarma')==null ? ( isset($chequeo)?$chequeo->fecha_alarma:'' ) : old('fecha_alarma') }}" readonly>
        </div>
        <div class="form-group">
            <label for="codigo" class= "label">Codigo</label>
            <input type="text" class="form-control" name="codigo" 
            value="{{ old('codigo_alarma')==null ? ( isset($chequeo)?$chequeo->codigo_alarma:'' ) : old('codigo_alarma') }}" readonly>
        </div>
        <div class="form-group">
            <label for="nombre_usuario" class= "label">Usuario</label>
            <input type="text" class="form-control" name="nombre_usuario"
            value="{{ old('nombre_usuario')==null ? ( isset($chequeo)?$chequeo->nombre_usuario:'' ) : old('nombre_usuario') }}" readonly>
        </div>
        <div class="form-group">
            <label for="calle" class= "label">Calle</label>
            <input type="text" class="form-control" name="calle" 
            value="{{ old('calle_direccion')==null ? ( isset($chequeo)?$chequeo->calle_direccion:'' ) : old('calle_direccion') }}" readonly>
        </div>
        <div class="form-group">
            <label for="numero" class= "label">Numero</label>
            <input type="text" class="form-control" name="numero" 
            value="{{ old('numero_direccion')==null ? ( isset($chequeo)?$chequeo->numero_direccion:'' ) : old('numero_direccion') }}" readonly>
        </div>

    </div>
    <div class="col-6">
        <h2>Modificar Chequeo</h2>
        <form method="POST" class="form form__container" action ="{{route('chequeos.handleGuardar')}}">
            @csrf
            @if(isset($chequeo))
                <input type="hidden" name="id" value="{{$chequeo->id}}">
            @endif
            
        
            <div class="form-group">
                <label for="fecha" class="label">Fecha*</label>
                <input type="date" class="form-control" name="fecha"
                value="{{ old('fecha')==null ? ( isset($chequeo)?$chequeo->fecha:'' ) : old('fecha') }}">
            </div>
            <div class="form-group">
                <label for="hora" class="label">Hora*</label>
                <input type="time" class="form-control" name="hora" 
                value="{{ old('hora')==null ? ( isset($chequeo)?$chequeo->hora:'' ) : old('hora') }}">
            </div>
            <div class="form-group">
                <label for="usuario_chequeo" class="label">Usuario chequeo*</label>
                <input type="text" class="form-control" name="usuario_chequeo"
                value="{{ old('usuario_chequeo')==null ? ( isset($chequeo)?$chequeo->usuario_chequeo:'' ) : old('usuario_chequeo') }}"readonly>
            </div>
            <div class="form-group">
                <label for="observacion" class="label">Observacion*</label>
                <input type="text" class="form-control" name="observacion" 
                value="{{ old('observacion')==null ? ( isset($chequeo)?$chequeo->observacion:'' ) : old('observacion') }}">
            </div>
            {{-- selector de tipo de chequeo --}}
            <div class="form-group">
                <label for="tipo_chequeo" class="label">Tipo chequeo*</label>
                <select class="form-control" name="tipo_chequeo">
                    @foreach ($tiposChequeo as $tipoChequeo)
                        <option value="{{$tipoChequeo->id}}" {{ old('tipo_chequeo')==null ? ( isset($chequeo) && $chequeo->tipo_chequeo==$tipoChequeo->id ? 'selected' : '' ) : ( old('tipo_chequeo')==$tipoChequeo->id ? 'selected' : '' ) }}>{{$tipoChequeo->nombre}}</option>
                    @endforeach
                    {{-- <option value="1" {{ old('tipo_chequeo')==null ? ( isset($chequeo) && $chequeo->tipo_chequeo==1 ? 'selected' : '' ) : ( old('tipo_chequeo')==1 ? 'selected' : '' ) }}>Presencial</option>
                    <option value="2" {{ old('tipo_chequeo')==null ? ( isset($chequeo) && $chequeo->tipo_chequeo==2 ? 'selected' : '' ) : ( old('tipo_chequeo')==2 ? 'selected' : '' ) }}>Llamada</option>
                    <option value="3" {{ old('tipo_chequeo')==null ? ( isset($chequeo) && $chequeo->tipo_chequeo==3 ? 'selected' : '' ) : ( old('tipo_chequeo')==3 ? 'selected' : '' ) }}>Mensaje</option>
                    <option value="4" {{ old('tipo_chequeo')==null ? ( isset($chequeo) && $chequeo->tipo_chequeo==4 ? 'selected' : '' ) : ( old('tipo_chequeo')==4 ? 'selected' : '' ) }}>Otro</option> --}}
                </select>
            </div>

            <div class="form-group">
                <label for="tipo_evento" class="label">Tipo evento*</label>
                <select class="form-control" name="tipo_evento">
                    @foreach ($tiposEvento as $tipoEvento)
                        <option value="{{$tipoEvento->id}}" {{ old('tipo_evento')==null ? ( isset($chequeo) && $chequeo->tipo_evento==$tipoEvento->id ? 'selected' : '' ) : ( old('tipo_evento')==$tipoEvento->id ? 'selected' : '' ) }}>{{$tipoEvento->nombre}}</option>
                    @endforeach
                    {{-- <option value="1" {{ old('tipo_evento')==null ? ( isset($chequeo) && $chequeo->tipo_evento==1 ? 'selected' : '' ) : ( old('tipo_evento')==1 ? 'selected' : '' ) }}>Robo</option>
                    <option value="2" {{ old('tipo_evento')==null ? ( isset($chequeo) && $chequeo->tipo_evento==2 ? 'selected' : '' ) : ( old('tipo_evento')==2 ? 'selected' : '' ) }}>Robo</option>
                    <option value="3" {{ old('tipo_evento')==null ? ( isset($chequeo) && $chequeo->tipo_evento==3 ? 'selected' : '' ) : ( old('tipo_evento')==3 ? 'selected' : '' ) }}>Falsa Alarma</option>
                    <option value="4" {{ old('tipo_evento')==null ? ( isset($chequeo) && $chequeo->tipo_evento==4 ? 'selected' : '' ) : ( old('tipo_evento')==4 ? 'selected' : '' ) }}>Otro</option> --}}
                </select>
            </div>
            <div class="d-flex justify-content-end py-2">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        
        </form>

    </div>

</div>






<div id="map" style="height: 400px; width: 100%; z-index: 0; margin: 3rem 0"></div>


@endsection
@section('scripts')
<script>
    const comunidad = <?php echo json_encode($comunidad); ?>;
    const latitud = <?php echo json_encode($chequeo->latitud); ?>;
    const longitud = <?php echo json_encode($chequeo->longitud); ?>;

</script>
<script type="text/javascript" src="{{ asset('js/chequeos/mapa.js') }}"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCJNN-iTg6exmzgXLjB_4KNGY_869oNBGM&v=beta&libraries=marker&callback=initMap"></script>
@endsection
