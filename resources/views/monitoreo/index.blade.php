@extends('layouts.app')
@section('title', 'Dashboard monitoreo')

@section('content')

<h2>Dashboard de monitoreo</h2>

<div id="map" style="height: 400px; width: 100%; z-index: 0; margin: 3rem 0"></div>

<button onclick="reload()">Recargar</button>

@endsection

@section('scripts')
{{-- TO DO: mover todo al mismo archivo de script --}}
<script>
    const comunidad = <?php echo json_encode($comunidad); ?>;
    const direcciones = <?php echo json_encode($direcciones); ?>;
    const csrf_token = <?php echo json_encode(csrf_token()); ?>;

    // const messagingMap = firebase.messaging();

    // messagingMap.onMessage((payload) => {
    //     console.log('Message received. ', payload);
    //     reload();
    // });


    async function reloadMap(){
        const alarmas = await obtenerAlarmas();
        console.log('reloadMap');
        
        
        generarMarcadores(alarmas);

    }

    async function obtenerAlarmas() {
        const url = '/monitoreo/getAlarmas';
        const respuesta = await fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrf_token,
            },
            body: JSON.stringify({comunidad_id: comunidad.id})
        })
        .then(res => res.json())
        .catch(error => console.error('Error:', error))
        .then(response => {
            return response.alarmas;
        });

        
        // Devuelve el error
        return await respuesta;
    }

    


</script>

<script type="text/javascript" src="{{ asset('js/monitoreo/mapa.js') }}"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCJNN-iTg6exmzgXLjB_4KNGY_869oNBGM&v=beta&libraries=marker&callback=initMap"></script>


@endsection
