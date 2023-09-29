@extends('layouts.app')
@section('title', 'Guardar dirección')


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
<h2  class="login-page-new__main-form-title">Crear dirección</h2>

<form method="POST" class="form form__container" action="{{route('direcciones.handleGuardar')}}" id="formulario">
    @csrf
    @if(isset($direccion))
        <input type="hidden" name="id" value="{{$direccion->id}}">
    @endif

    <div class="mb-3">
        <label for="rut" class="form-label">Rut*</label>
        <input type="text" class="form-control" name="rut" required
        value="{{ old('rut')==null ? ( isset($direccion)?$direccion->rut:'' ) : old('rut') }}">
    </div>
    <div class="mb-3">
        <label for="digito" class="form-label">Digito*</label>
        <input type="text" class="form-control" name="digito" required
        value="{{ old('digito')==null ? ( isset($direccion)?$direccion->digito:'' ) : old('digito') }}">
    </div>
    <div class="mb-3">
        <label for="calle" class="form-label">Calle*</label>
        <input type="text" class="form-control" name="calle" required
        value="{{ old('calle')==null ? ( isset($direccion)?$direccion->calle:'' ) : old('calle') }}">
    </div>
    <div class="mb-3">
        <label for="numero" class="form-label">Numero*</label>
        <input type="text" class="form-control" name="numero" required
        value="{{ old('numero')==null ? ( isset($direccion)?$direccion->numero:'' ) : old('numero') }}">
    </div>
    <div class="mb-3">
        <label for="representante" class="form-label">Representante*</label>
        <input type="text" class="form-control" name="representante" required
        value="{{ old('representante')==null ? ( isset($direccion)?$direccion->representante:'' ) : old('representante') }}">
    </div>

    <div class="d-grid gap-2 py-2">
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>

    <label class="label" for="direccion">Dirección</label>
        <div class="form__container-flex">
            <input class="input" type="text" list="direcciones" name="direccion" id="direccion" required value="{{ old('direccion')==null ? ( isset($sucursal)?$sucursal->direccion:'' ) : old('direccion') }}">
            <button type="button" class="btn btn-primary" id="btn-geolocalizacion">Obtener ubicación</button>

            {{-- Datalist --}}
            <datalist id="direcciones"></datalist>
        </div>
        
        <div id="map" style="height: 400px; width: 100%; z-index: 0; margin: 3rem 0"></div>
    
    <input class="input" type="text" name="latitud" id="latitud" value="{{ old('latitud')==null ? ( isset($sucursal)?$sucursal->latitud:'' ) : old('latitud') }}" hidden>
    <input class="input" type="text" name="longitud" id="longitud" value="{{ old('longitud')==null ? ( isset($sucursal)?$sucursal->longitud:'' ) : old('longitud') }}" hidden>

    <label class="label" for="radio">Radio en metros</label>
    <div class="form__container-flex">
        <input class="input" type="text" name="radio" id="radio" value="{{ old('radio')==null ? ( isset($sucursal)?$sucursal->radio:'100' ) : old('radio') }}"
        placeholder="Ingresa el radio en metros" required>
        <!--boton latitud y longitud-->
        <button type="button" class="btn btn-primary" id="radio-button">
            Visualizar radio
        </button>
    </div>
</form>



@endsection


@section('scripts')
    <script src="{{ asset('js/direcciones/mapa.js') }}"></script>
@endsection
