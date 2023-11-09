// Obtener html
const geoButton = document.getElementById("btn-geolocalizacion");
const input = document.getElementById("direccion");
const latitudInput = document.getElementById("latitud");
const longitudInput = document.getElementById("longitud");

//obtener calle
// const calleInput = document.getElementById("calle");
// const numeroInput = document.getElementById("numero");
// direccion
const calleInput = document.getElementById("direccion");

// Formulario
handleEnviarFormulario = (event) => {
    // Verificar enter y  si direccion esta focuseado
    if(event.keyCode == 13 && document.getElementById("direccion").matches(":focus")){
        event.preventDefault();
        return;
    }
}



let map;

function setCalleNumero(arreglo){
    // update calleInput and numeroInput
    calleInput.value = "";
    var calle;
    var numero;
    arreglo.forEach( (address_component) => {
        if( address_component.types.includes("route") ){
            calle = address_component.long_name;
        }
        if( address_component.types.includes("street_number") ){
            numero = address_component.long_name;
        }
    });
    calleInput.value = calle+" "+numero;
}



async function initMap() {
    const { Map } = await google.maps.importLibrary("maps");

    map = new Map(document.getElementById("map"), {
        center: { 
            lat: -33.4569400,
            lng: -70.6482700 },
        zoom: 13,
    });

    const input = document.getElementById("direccion");

    const autocomplete = new google.maps.places.Autocomplete(
        input
    );

    autocomplete.bindTo("bounds", map);

    const infowindow = new google.maps.InfoWindow();

    const marker = new google.maps.Marker({
        map: map,
        anchorPoint: new google.maps.Point(0, -29),
    });

    autocomplete.addListener("place_changed", () => {
        infowindow.close();
        marker.setVisible(false);
        const place = autocomplete.getPlace();

        // update calleInput and numeroInput
        setCalleNumero(place.address_components);

        if (!place.geometry) {
            window.alert("No hay detalles disponibles para: '" + place.name + "'");
            return;
        }

        // If the place has a geometry, then present it on a map.
        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        } else {
            map.setCenter(place.geometry.location);
        }

        // Obtener direccion
        const position = {
            lat: place.geometry.location.lat(),
            lng: place.geometry.location.lng()
        };

        // Update latitud and longitud
        handleUpdatePosition( 
            position.lat, 
            position.lng,
            );
    });

    // GeoLocalizacion
    const geoButton = document.getElementById("btn-geolocalizacion");
    geoButton.addEventListener("click", () => {
        // Try HTML5 geolocation.
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                (position) => {

                    const pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude,
                    };
                    handleUpdatePosition(
                        pos.lat, 
                        pos.lng);
                },
                () => {
                    handleLocationError(true, infowindow, map.getCenter());
                }
            );
        } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, infowindow, map.getCenter());
        }
    } );

    // Evento click en el mapa
    map.addListener("click", (e) => {
        // Set marker to click position
        handleUpdatePosition( e.latLng.lat(), e.latLng.lng() );
    });

    const handleUpdatePosition = ( lat, lng ) => {
        // Set position
        const position = {
            lat: lat,
            lng: lng
        };
        // Update latitud and longitud
        latitudInput.value = lat;
        longitudInput.value = lng;

        // Update direccion
        const geocoder = new google.maps.Geocoder();
        geocoder.geocode({
            location: position
        }, (results, status) => {
            if (status === "OK") {
                if (results[0]) {
                    setCalleNumero(results[0].address_components);
                    input.value = results[0].formatted_address;
                } else {
                    window.alert("No se encontraron resultados");
                }
            } else {
                window.alert("Geocoder failed due to: " + status);
            }
        });

        // Set marker to latitud and longitud
        marker.setPosition(position);
        marker.setVisible(true);
        map.panTo(position);

    };



    if( latitudInput.value && longitudInput.value ){
        handleUpdatePosition( 
            parseFloat(latitudInput.value), 
            parseFloat(longitudInput.value),
            calleInput.value,
            numeroInput.value );
    }
    
}

initMap();

