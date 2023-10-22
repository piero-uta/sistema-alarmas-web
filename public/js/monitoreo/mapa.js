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
}