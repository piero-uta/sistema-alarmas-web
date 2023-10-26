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
            lat: -33.4569400,
            lng: -70.6482700 },
        zoom: 13,
        mapId:'eff1eb88ba92ef89',
    });
}


function generarMarcadores(alarmas = null){
    console.log("dentro de funcion: "+ alarmas);
    direcciones.forEach(direccion => {
        const greyBackground = new google.maps.marker.PinView({
            borderColor: "#808080",
            background: "#808080",
            glyphColor: "#000000",
        });
        // create the marker
        const marker = new google.maps.marker.AdvancedMarkerView({
            position: {lat:direccion.latitud, lng:direccion.longitud},
            map: map,
            title: direccion.codigo,
            content: greyBackground.element,
        });
        markers.push(marker);
    });


}