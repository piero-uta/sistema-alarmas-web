@extends('layouts.app')
@section('title', 'Guardar comunidad')


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
<h1 >Crear comunidad</h1>

<form method="POST"  action="{{route('comunidades.handleGuardar')}}">
    @csrf
    @if(isset($comunidad))
        <input type="hidden" name="id" value="{{$comunidad->id}}">
    @endif

    <div class="form-group">
        <label for="rut" class="label">Rut*</label>
        <input type="number" class="form-control" name="rut" required
        value="{{ old('rut')==null ? ( isset($comunidad)?$comunidad->rut:'' ) : old('rut') }}">
    </div>
    <div class="form-group">
        <label for="digito" class="label">Digito*</label>
        <input type="text" class="form-control" name="digito"required
        value="{{ old('digito')==null ? ( isset($comunidad)?$comunidad->digito:'' ) : old('digito') }}">
    </div>
    <div class="form-group">
        <label for="razon_social" class="label">Razon social*</label>
        <input type="text" class="form-control" name="razon_social" required
        value="{{ old('razon_social')==null ? ( isset($comunidad)?$comunidad->razon_social:'' ) : old('razon_social') }}">
    </div>
    <div class="form-group">
        <label for="representante_legal" class="label">Representante legal</label>
        <input type="text" class="form-control" name="representante_legal" 
        value="{{ old('representante_legal')==null ? ( isset($comunidad)?$comunidad->representante_legal:'' ) : old('representante_legal') }}">
    </div>
    <div class="form-group">
        <label for="email" class="label">Email</label>
        <input type="email" class="form-control" name="email"
        value="{{ old('email')==null ? ( isset($comunidad)?$comunidad->email:'' ) : old('email') }}">
    </div>
    {{-- <div class="mb-3">
        <label for="calle" class="form-label">Calle*</label>
        <input type="text" class="form-control" name="calle" required id ="calle"
        value="{{ old('calle')==null ? ( isset($comunidad)?$comunidad->calle:'' ) : old('calle') }}">
    </div>
    <div class="mb-3">
        <label for="numero" class="form-label">Numero*</label>
        <input type="text" class="form-control" name="numero" required id ="numero"
        value="{{ old('numero')==null ? ( isset($comunidad)?$comunidad->numero:'' ) : old('numero') }}">
    </div> --}}
    <div class="mb-3">
        <label for="direccion" class="form-label">Direccion*</label>
        <input type="text" class="form-control" name="direccion" required id ="direccion"
        value="{{ old('direccion')==null ? ( isset($comunidad)?$comunidad->direccion:'' ) : old('direccion') }}">
    </div>
    <div class="form-group">
        <label for="giro" class="label">Giro</label>
        <input type="text" class="form-control" name="giro" 
        value="{{ old('giro')==null ? ( isset($comunidad)?$comunidad->giro:'' ) : old('giro') }}">
    <div class="form-group">
        <label for="tipo_servicio" class="label">Tipo servicio*</label>
        <input type="text" class="form-control" name="tipo_servicio" required
        value="{{ old('tipo_servicio')==null ? ( isset($comunidad)?$comunidad->tipo_servicio:'' ) : old('tipo_servicio') }}">
    </div>
    <div class="form-group">
        <label for="costo_mensual" class="label">Costo mensual*</label>
        <input type="number" class="form-control" name="costo_mensual" required
        value="{{ old('costo_mensual')==null ? ( isset($comunidad)?$comunidad->costo_mensual:'' ) : old('costo_mensual') }}">
    </div>
    <div class="form-group">
        <label for="telefono" class="label">Telefono</label>
        <input type="number" class="form-control" name="telefono" 
        value="{{ old('telefono')==null ? ( isset($comunidad)?$comunidad->telefono:'' ) : old('telefono') }}">
    </div>
    <div class="form-group">
        <label for="celular" class="label">Celular</label>
        <input type="number" class="form-control" name="celular" 
        value="{{ old('celular')==null ? ( isset($comunidad)?$comunidad->celular:'' ) : old('celular') }}">
    </div>
    {{-- checkbox para saber si esta activo --}}
    <div class="checkbox">
        <input class="checkbox" type="checkbox" name="activo" id="activo" 
        {{ old('activo')==null 
            ? ( isset($comunidad) && $comunidad->activo==0 ? '' : 'checked' ) 
            : ( old('activo')==1 ? 'checked' : '' ) }}>
        <label class="label" for="activo">
            Activo
        </label>

    </div>

    <label class="label" for="direccion">Buscar dirección</label>
        <div class="form__container-flex">
            <input class="input" type="text" list="direcciones" name="direccion" id="direccion" value="{{ old('direccion')==null ? ( isset($comunidad)?$comunidad->direccion:'' ) : old('direccion') }}">
            <button type="button" class="btn btn-primary" id="btn-geolocalizacion">Obtener ubicación</button>

            {{-- Datalist --}}
            <datalist id="direcciones"></datalist>
        </div>
        
        <div id="map" style="height: 400px; width: 100%; z-index: 0; margin: 3rem 0"></div>
    
    <input class="input" type="text" name="latitud" id="latitud" value="{{ old('latitud')==null ? ( isset($comunidad)?$comunidad->latitud:'' ) : old('latitud') }}" hidden required>
    <input class="input" type="text" name="longitud" id="longitud" value="{{ old('longitud')==null ? ( isset($comunidad)?$comunidad->longitud:'' ) : old('longitud') }}" hidden required>


    <div class="d-flex justify-content-end py-2">
        <button type="submit" class="btn btn-primary" style="margin-right: 20px;">Guardar</button>
        <button type="submit" class="btn btn-danger">Cancelar</button>
                
    </div>
</form>


@endsection

@section('scripts')
    <script src="{{ asset('js/comunidad/mapa.js') }}"></script>
@endsection
