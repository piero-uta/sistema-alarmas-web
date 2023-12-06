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
    
}


function generarMarcadores(){
    const pinBackground = new google.maps.marker.PinView({
        borderColor: "#FF0000",
        background: "#FF0000",
        glyphColor: "#FFFFFF",
    });
    
    // create the marker
    const marker = new google.maps.marker.AdvancedMarkerView({
        position: {lat:latitud, lng:longitud},
        map: map,
        title: "Alarma activada",
        content: pinBackground.element,
    });
    markers.push(marker);
    


}