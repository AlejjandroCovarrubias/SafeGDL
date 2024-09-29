document.addEventListener("DOMContentLoaded", function() {
    // Inicializamos el mapa
    let map = L.map('map').setView([20.659249, -103.325971], 16);
    let startlat = null;
    let startlng = null;

    function obtenerCoordenadas() {
        if (navigator.geolocation) {
            navigator.geolocation.watchPosition(function (posicion) {
                const lat = posicion.coords.latitude;
                const lng = posicion.coords.longitude;
                startlat = lat;
                startlng = lng;
                actCoords(lat, lng);
                console.log(lat,lng);
            }, function(error) {
                console.error("ERROR: No localizacion");
            }, {
                enableHighAccuracy: true,
                timeout: 5000,
                maximumAge: 0 // Para que no use info del cache
            });
        }
    }

    let marker;

    function actCoords(lat,lng){
        if(marker){
            map.removeLayer(marker);
        }

        marker = L.marker([lat,lng]).addTo(map)
            .bindPopup('Estás aquí')
    }

    obtenerCoordenadas();
    
    // Capa de mapa
    const layer = L.tileLayer(`https://api.maptiler.com/maps/streets-v2/{z}/{x}/{y}.png?key=${key}`, {
        tileSize: 512,
        zoomOffset: -1,
        minZoom: 1,
        attribution: "\u003ca href=\"https://www.maptiler.com/copyright/\" target=\"_blank\"\u003e\u0026copy; MapTiler\u003c/a\u003e \u003ca href=\"https://www.openstreetmap.org/copyright\" target=\"_blank\"\u003e\u0026copy; OpenStreetMap contributors\u003c/a\u003e",
        crossOrigin: true
    }).addTo(map);

    let routingControl; // Variable para almacenar el control de enrutamiento

    // Control de búsqueda con Nominatim
    const searchControl = L.Control.geocoder({
        collapsed: false,
        placeholder: 'Buscar...',
        errorMessage: 'No se encontraron resultados',
        geocoder: new L.Control.Geocoder.Nominatim({
            serviceUrl: 'https://nominatim.openstreetmap.org/',
            params: {
                format: 'json',
                addressdetails: 1,
                limit: 5,
            }
        })
    }).on('markgeocode', function(e) {
        const latlng = e.geocode.center;
        L.marker(latlng).addTo(map)
            .bindPopup(e.geocode.name)
            .openPopup();
        map.setView(latlng, 16);
        
        // Borra la ruta anterior si existe
        if (routingControl) {
            map.removeControl(routingControl); // Elimina el control anterior
        }
        
        // Aquí puedes agregar la lógica para calcular la ruta
        calcularRuta(latlng); // calcula ruta al nuevo marcador
    }).addTo(map);

    // Función para calcular la ruta
    function calcularRuta(end) {
        routingControl = L.Routing.control({
            waypoints: [
                L.latLng(startlat,startlng),
                L.latLng(end.lat, end.lng)
            ],
            routeWhileDragging: true,
            geocoder: L.Control.Geocoder.nominatim()
        }).addTo(map);
    }
});

