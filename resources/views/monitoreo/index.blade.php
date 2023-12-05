    @extends('layouts.app')
    @section('title', 'Dashboard monitoreo')

    @section('content')

    <h2>Dashboard de monitoreo</h2>

    <div id="map" style="height: 400px; width: 100%; z-index: 0; margin: 3rem 0"></div>

    <button onclick="reload()">Recargar</button>
    <!-- Agrega la tabla debajo del mapa -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped" id="tablaDatos">
            <thead class="thead-dark">
                <tr>
                    <th>Alarma ID</th>
                    <th>Fecha Alarma</th>
                    <th>Hora Alarma</th>
                    <th>nombre usuario</th>
                    <th>codigo</th>
                    <th>Acciones</th>
                    <!-- Agrega más columnas según tus necesidades -->
                </tr>
            </thead>
            <tbody>
                <!-- Agrega las filas según tus necesidades -->

            </tbody>
        </table>
    </div>
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
            const data = await obtenerAlarmas();
            const alarmas = data.alarmas;
            const chequeos = data.chequeos;

            console.log('reloadMap');
            
            
            generarMarcadores(alarmas);
        // Limpia la tabla antes de agregar nuevos datos
        const tbody = document.getElementById('tablaDatos').querySelector('tbody');
        tbody.innerHTML = '';

    // Itera sobre las alarmas y agrega filas a la tabla
    for (let i = 0; i < alarmas.length; i++) {
        const alarma = alarmas[i];
        const chequeo = chequeos.find(c => c.id_alarma === alarma.id);

        const fila = `<tr>
                        <td>${alarma.id || ''}</td>
                        <td>${alarma.fecha || ''}</td>
                        <td>${alarma.hora || ''}</td>
                        <td>${alarma.nombre_usuario}</td>
                        <td>${alarma.codigo}</td>
                        <td>
                            <button onclick="verChequeo(${chequeo.id})">Ver Chequeo</button>
                        </td>
                    </tr>`;
        tbody.innerHTML += fila;
    }
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
                console.log( response);
                return response;
            });

            
            // Devuelve el error
            return await respuesta;

            
        }
        async function verChequeo(idChequeo) 
        {
    // Puedes hacer algo con el idChequeo, por ejemplo, redirigir a una página específica
    // o realizar alguna otra acción basada en ese ID
    window.location.href = `/chequeos/crear?id=${idChequeo}`;
        }





    </script>

    <script type="text/javascript" src="{{ asset('js/monitoreo/mapa.js') }}"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCJNN-iTg6exmzgXLjB_4KNGY_869oNBGM&v=beta&libraries=marker&callback=initMap"></script>


    @endsection
