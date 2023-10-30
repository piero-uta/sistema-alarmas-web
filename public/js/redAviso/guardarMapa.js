let map;
let markers = [];

async function initMap() {
    const { Map } = await google.maps.importLibrary("maps");

    map = new Map(document.getElementById("map"), {
        center: { 
            lat: -33.4569400,
            lng: -70.6482700 },
        zoom: 13,
    });

    // actualizar mapa cuando cambie vecinoInput
    idDireccionVecinoInput.addEventListener("change", () => {
        // remove all markers
        markers.forEach(marker => {
            marker.setMap(null);
        });

        const vecino = idDireccionVecinoInput.value;
        if( vecino === "" ){
            map.setCenter({ 
                lat: -33.4569400,
                lng: -70.6482700 });
            return;
        }
        // buscar vecino en vecinos, donde vecinos[n].id === vecino
        direccionesVecinos.forEach(direccion => {
            if( direccion.id == vecino ){
                map.setCenter({ 
                    lat: direccion.latitud,
                    lng: direccion.longitud
                     });
                // create the marker
                const marker = new google.maps.Marker({
                    position: {lat:direccion.latitud, lng:direccion.longitud},
                    map: map,
                    title: direccion.codigo,
                });
                markers.push(marker);
                return;
            }
            
        });
    });

}
initMap();
