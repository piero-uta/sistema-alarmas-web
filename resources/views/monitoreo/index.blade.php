    @extends('layouts.app')
    @section('title', 'Dashboard monitoreo')

    @section('content')

    <h2>Dashboard de monitoreo</h2>

    <div id="map" style="height: 400px; width: 100%; z-index: 0; margin: 3rem 0"></div>

    {{-- <button onclick="reload()">Recargar</button> --}}
    <!-- Agrega la tabla debajo del mapa -->
    <div class="table-responsive">
        <table id="myTable" class="display" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th></th>
                    <th>Fecha Alarma</th>
                    <th>Hora Alarma</th>
                    <th>Nombre usuario</th>
                    <th>Dirección</th>
                    <th>Chequeado</th>
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
        var table = new DataTable('#myTable', {
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
            },
            order: [[2, 'desc']],
            order: [[3, 'desc']]
        });    
        // lista de alarmas
        let alarmas_list = [];

        async function reloadMap(){
            const data = await obtenerAlarmas();
            const alarmas = data.alarmas;
            const chequeos = data.chequeos;

            console.log('reloadMap');
            
            
            generarMarcadores(alarmas);
            // Limpia la tabla antes de agregar nuevos datos
            const tbody = document.getElementById('myTable').querySelector('tbody');
            tbody.innerHTML = '';

            // Itera sobre las alarmas y agrega filas a la tabla
            for (let i = 0; i < alarmas.length; i++) {
                const alarma = alarmas[i];
                // buscar alarma en lista de alarmas
                if(alarmas_list.find(a => a.id === alarma.id)){
                    continue;
                }
                const chequeo = chequeos.find(c => c.id_alarma === alarma.id);
                const direccion = direcciones.find(d => d.id === alarma.direccion_id);

                // Agrega una clase y el ícono de FontAwesome en función del estado de chequeo
                const claseFila = chequeo.estado_chequeo == 1 ? '' : 'fila-alerta';

                const iconoChequeo = chequeo.estado_chequeo == 1 ? '' : '<i class="fas fa-exclamation-triangle text-danger"></i>';

                const fila = `<tr class="${claseFila}" style="border: ${chequeo.estado_chequeo == 1 ? '' : '2px solid red; border-radius: 10px; background-color: #f8d7da;'}">
                                <td>${iconoChequeo || ''}</td>
                    
                                <td>${alarma.fecha || ''}</td>
                                <td>${alarma.hora || ''}</td>
                                <td>${alarma.nombre_usuario}</td>
                                <td>${direccion.calle} ${direccion.numero}</td>
                                <td>${chequeo.estado_chequeo == 1 ? "Si": "No"}</td>
                                <td>
                                <button class="btn btn-primary" style="background: none; border: none; padding: 0;" onclick="verChequeo(${chequeo.id})">
                                <div style="width: 38px; height: 38px; background-color: white; overflow: hidden;">
                                        <img src="{{ asset('img/iconos/icono13.png') }}" style="display: block; width: 60px; height: 60px; margin: -11px 0 0 -11px;" clip: ; alt="Icono 1">
                                    </div>
                                </td>
                            </tr>`;
                // Agrega la fila a la tabla
                alarmas_list.push(alarma);
                // tbody.innerHTML += fila;
                table.row.add($(fila)).draw();
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
    <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&v=beta&libraries=marker&callback=initMap"></script>
    
    @endsection
