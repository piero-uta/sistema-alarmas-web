@extends('layouts.app')
@section('title', 'Guardar dirección')


@push('head-scripts')
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    {{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCJNN-iTg6exmzgXLjB_4KNGY_869oNBGM&callback=initMap&libraries=places&v=weekly" defer></script> --}}
    <script>
        (g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})({
            key: "{{ env('GOOGLE_MAPS_API_KEY') }}",
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
        <input type="text" class="form-control" name="calle" required id ="calle"
        value="{{ old('calle')==null ? ( isset($direccion)?$direccion->calle:'' ) : old('calle') }}">
    </div>
    <div class="mb-3">
        <label for="numero" class="form-label">Numero*</label>
        <input type="number" class="form-control" name="numero" required id ="numero"
        value="{{ old('numero')==null ? ( isset($direccion)?$direccion->numero:'' ) : old('numero') }}">
    </div>
    <div class="mb-3">
        <label for="representante" class="form-label">Representante*</label>
        <input type="text" class="form-control" name="representante" required
        value="{{ old('representante')==null ? ( isset($direccion)?$direccion->representante:'' ) : old('representante') }}">
    </div>

    {{-- codigo --}}
    <div class="mb-3">
        <label for="codigo" class="form-label">Codigo*</label>
        <input type="text" class="form-control" name="codigo" required
        value="{{ old('codigo')==null ? ( isset($direccion)?$direccion->codigo:'' ) : old('codigo') }}">
    </div>


    <label class="label" for="direccion">Dirección</label>
        <div class="form__container-flex">
            <input class="input" type="text" list="direcciones" name="direccion" id="direccion" value="{{ old('direccion')==null ? ( isset($direccion)?$direccion->calle .' '. strval($direccion->numero):'' ) : old('direccion') }}">
            <button type="button" class="btn btn-primary" id="btn-geolocalizacion" style="background: #509fd8;">Obtener ubicación</button>

            {{-- Datalist --}}
            <datalist id="direcciones"></datalist>
        </div>
        
        <div id="map" style="height: 400px; width: 100%; z-index: 0; margin: 3rem 0"></div>
    
    <input class="input" type="text" name="latitud" id="latitud" value="{{ old('latitud')==null ? ( isset($direccion)?$direccion->latitud:'' ) : old('latitud') }}" hidden>
    <input class="input" type="text" name="longitud" id="longitud" value="{{ old('longitud')==null ? ( isset($direccion)?$direccion->longitud:'' ) : old('longitud') }}" hidden>

    <div class="d-flex justify-content-end py-2">
        <button type="submit" class="btn btn-primary" style="margin-right: 20px; background: #509fd8;">Guardar</button>
        <a class="btn btn-danger" href="javascript:history.back()">Cancelar</a>
    </div>
</form>



@endsection


@section('scripts')
<script>
    const comunidad = <?php echo json_encode($comunidad); ?>;
</script>
<script type="text/javascript" src="{{ asset('js/direcciones/mapa.js') }}"></script>
@endsection
