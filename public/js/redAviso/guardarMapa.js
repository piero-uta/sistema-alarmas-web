let map;
let markers = [];

async function initMap() {
    const { Map } = await google.maps.importLibrary("maps");

    map = new Map(document.getElementById("map"), {
        center: { 
            lat: comunidad.latitud,
            lng: comunidad.longitud },
        zoom: comunidad.zoom,
    });

    if(idDireccionVecinoInput.value !== ""){
        actualizarMapa();
    }

    // actualizar mapa cuando cambie vecinoInput
    idDireccionVecinoInput.addEventListener("change", () => {
        actualizarMapa();
        
    });

}

// funcion actualizar mapa
function actualizarMapa(){
    // remove all markers
    markers.forEach(marker => {
        marker.setMap(null);
    });

    const vecino = idDireccionVecinoInput.value;
    if( vecino === "" ){
        map.setCenter({ 
            lat: comunidad.latitud,
            lng: comunidad.longitud });
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
}


initMap();
