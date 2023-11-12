let markers = [];

var map;


async function initMap() {
    markers.forEach(marker => {
        marker.setMap(null);
    });

    mapDiv = document.getElementById("map");
    if( mapDiv === null ) return;


    map = new google.maps.Map(mapDiv, {
        center: { 
            lat: comunidad.latitud,
            lng: comunidad.longitud },
        zoom: comunidad.zoom,
        mapId:'eff1eb88ba92ef89',
    });

    generarMarcadores();
    reloadMap();
}


function generarMarcadores(alarmas = null){
    direcciones.forEach(direccion => {

        const pinBackground = new google.maps.marker.PinView({
            borderColor: "#808080",
            background: "#808080",
            glyphColor: "#000000",
        });

        if( alarmas !== null ){

            for (let i = 0; i < alarmas.length; i++) {
                const alarma = alarmas[i];
                if( alarma.direccion_id === direccion.id ){
                    pinBackground.borderColor = "#FF0000";
                    pinBackground.background = "#FF0000";
                    pinBackground.glyphColor = "#FFFFFF";
                }
            }
        }
        
        // create the marker
        const marker = new google.maps.marker.AdvancedMarkerView({
            position: {lat:direccion.latitud, lng:direccion.longitud},
            map: map,
            title: direccion.codigo,
            content: pinBackground.element,
        });
        markers.push(marker);
    });


}