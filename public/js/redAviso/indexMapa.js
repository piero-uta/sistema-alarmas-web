let markers = [];


async function initMap() {
    markers.forEach(marker => {
        marker.setMap(null);
    });

    mapDiv = document.getElementById("map");
    if( mapDiv === null ) return;


    const map = new google.maps.Map(mapDiv, {
        center: { 
            lat: -33.4569400,
            lng: -70.6482700 },
        zoom: 13,
        mapId:'eff1eb88ba92ef89',
    });

    
    

    

    const direccionesVecinos = [];
    var direccionPrincipal = {};
    direcciones.forEach(direccion => {
        if(direccion_id === direccion.id){
            direccionPrincipal = direccion;
        }
        redes.forEach(red => {
            if(red.direccion_vecino_id === direccion.id){
                direccionesVecinos.push(direccion);
            }
        });
    });

    const principalBackground = new google.maps.marker.PinView({
        background: "#a83232",
    });
    // create the marker
    const marker = new google.maps.marker.AdvancedMarkerView({
        position: {lat:direccionPrincipal.latitud, lng:direccionPrincipal.longitud},
        map: map,
        title: direccionPrincipal.codigo,
        content: principalBackground.element,
    });

    markers.push(marker);

    direccionesVecinos.forEach(direccion => {
        const vecinosBackground = new google.maps.marker.PinView({
            background: "#f2de29",
        });
        // create the marker
        const marker = new google.maps.marker.AdvancedMarkerView({
            position: {lat:direccion.latitud, lng:direccion.longitud},
            map: map,
            title: direccion.codigo,
            content: vecinosBackground.element,
        });
        markers.push(marker);
    });
}
