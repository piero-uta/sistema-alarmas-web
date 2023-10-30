@extends('layouts.app')
@section('title', 'Guardar red de aviso')

@push('head-scripts')
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    {{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCJNN-iTg6exmzgXLjB_4KNGY_869oNBGM&callback=initMap&libraries=places&v=weekly" defer></script> --}}
    <script>
        (g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})({
            key: "AIzaSyCJNN-iTg6exmzgXLjB_4KNGY_869oNBGM",
            v: "weekly",    
            libraries: "places",
            languaje: "es",
        });
      </script>

@endpush


@section('content')
    <h2>Crear red de aviso para {{$direccionSeleccionada->codigo}}</h2>
    <form method="POST" class="form form__container" action="{{ route('red-avisos.handleGuardar') }}">
        @csrf
        @if (isset($red))
            <input type="hidden" name="id" value="{{ $red->id }}">
        @endif

        <input type="hidden" name="direccion_id" value="{{ $direccionSeleccionada->id }}">

        <div class="form-group">
            <label for="direccion">Dirección del vecino</label>
            <select class="form-control" id="direccion" name="direccion_vecino_id">
                <option value="">Seleccionar</option>
                @foreach ($direcciones as $direccion)
                    <option value="{{$direccion->id}}" {{ old('direccion_vecino_id') == null
                        ? (isset($red) && $red->direccion_vecino_id == $direccion->id
                            ? 'selected'
                            : '')
                        : (old('direccion_vecino_id') == $direccion->id
                            ? 'selected'
                            : '') }}>{{$direccion->codigo}}</option>
                @endforeach
            </select>
        </div>
        {{-- checkbox para saber si esta activo --}}
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="activo" id="activo" 
                {{ old('activo') == null
                    ? (isset($usuario) && $usuario->activo == 0
                        ? ''
                        : 'checked')
                    : (old('activo') == 1
                        ? 'checked'
                        : '') }}>
            <label class="form-check-label" for="activo">
                Activo
            </label>

        </div>

        <div id="map" style="height: 400px; width: 100%; z-index: 0; margin: 3rem 0"></div>



        <div class="d-grid gap-2 py-2">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a class="btn btn-primary" href="/red-avisos">Cancelar</a>
        </div>
    </form>
@endsection

@section('scripts')
<script>
    const direccionSeleccionada=<?php echo json_encode($direccionSeleccionada); ?>;
    const idDireccionVecinoInput = document.getElementById('direccion');
    const direccionesVecinos = <?php echo json_encode($direcciones); ?>;
</script>
    <script type="text/javascript" src="{{ asset('js/redAviso/guardarMapa.js') }}"></script>
@endsection
