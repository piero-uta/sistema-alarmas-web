let markers = [];


async function initMap() {
    markers.forEach(marker => {
        marker.setMap(null);
    });

    mapDiv = document.getElementById("map");
    if( mapDiv === null ) return;


    const map = new google.maps.Map(mapDiv, {
        center: { 
            lat: comunidad.latitud,
            lng: comunidad.longitud },
        zoom: comunidad.zoom,
        mapId:'eff1eb88ba92ef89',
    });

    
    

    

    const direccionesVecinosRed = [];
    // Direcciones que no estan en la red, se mostraban con gris, ahora ya no se muestran
    // const direccionesVecinos = [];
    var direccionPrincipal = {};
    direcciones.forEach(direccion => {
        // direccionesVecinos.push(direccion);
        if(direccion_id === direccion.id){
            direccionPrincipal = direccion;
            //quitar direccionPrincipal de direccionesVecinos
            // direccionesVecinos.pop(direccion);
            
        }
        const redEncontrada = redes.forEach(red => {
            if(red.direccion_vecino_id === direccion.id){
                direccionesVecinosRed.push(direccion);
                //quitar direccion de direccionesVecinos
                // direccionesVecinos.pop(direccion);
            }
        });
    });
    // LOG para revisar cosas
    // console.log("principal: "+direccionPrincipal);
    // console.log("red: "+direccionesVecinosRed);
    // console.log("otros: "+direccionesVecinos);

    const redBackground = new google.maps.marker.PinView({
        borderColor: "#a83232",
        background: "#a83232",
        glyphColor: "#000000",
    });
    // create the marker
    const marker = new google.maps.marker.AdvancedMarkerView({
        position: {lat:direccionPrincipal.latitud, lng:direccionPrincipal.longitud},
        map: map,
        title: direccionPrincipal.codigo,
        content: redBackground.element,
    });

    markers.push(marker);

    direccionesVecinosRed.forEach(direccion => {
        const yellowBackground = new google.maps.marker.PinView({
            borderColor: "#f2de29",
            background: "#f2de29",
            glyphColor: "#000000",
        });
        // create the marker
        const marker = new google.maps.marker.AdvancedMarkerView({
            position: {lat:direccion.latitud, lng:direccion.longitud},
            map: map,
            title: direccion.codigo,
            content: yellowBackground.element,
        });
        markers.push(marker);
    });

    // direccionesVecinos.forEach(direccion => {
    //     console.log("agregando otros");
    //     const greyBackground = new google.maps.marker.PinView({
    //         borderColor: "#808080",
    //         background: "#808080",
    //         glyphColor: "#000000",
    //     });
    //     // create the marker
    //     const marker = new google.maps.marker.AdvancedMarkerView({
    //         position: {lat:direccion.latitud, lng:direccion.longitud},
    //         map: map,
    //         title: direccion.codigo,
    //         content: greyBackground.element,
    //     });
    //     markers.push(marker);
    // });
}
