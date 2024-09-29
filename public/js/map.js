document.addEventListener("DOMContentLoaded", function() {
    // Inicializamos el mapa (falta poner direcciones de forma dinamica, ahorita pone las de cucei con zoom de 16%)
    let map = L.map('map');

    map.setView([20.659249, -103.325971], 16);

    function obtenerCoordenadas() {
        if (navigator.geolocation) {
            navigator.geolocation.watchPosition(function (posicion) {
                const lat = posicion.coords.latitude;
                const lng = posicion.coords.longitude;
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

    const layer = L.tileLayer(`https://api.maptiler.com/maps/streets-v2/{z}/{x}/{y}.png?key=${key}`,{
        tileSize: 512,
        zoomOffset: -1,
        minZoom: 1,
        attribution: "\u003ca href=\"https://www.maptiler.com/copyright/\" target=\"_blank\"\u003e\u0026copy; MapTiler\u003c/a\u003e \u003ca href=\"https://www.openstreetmap.org/copyright\" target=\"_blank\"\u003e\u0026copy; OpenStreetMap contributors\u003c/a\u003e",
        crossOrigin: true
      }).addTo(map);

    // Control de búsqueda con Nominatim
    const searchControl = L.Control.geocoder({
        collapsed: false,
        placeholder: 'Buscar...',
        errorMessage: 'No se encontraron resultados',
        // Función para obtener resultados enriquecidos
        geocoder: new L.Control.Geocoder.Nominatim({
            serviceUrl: '   https://nominatim.openstreetmap.org/',
            params: {
                format: 'json',
                addressdetails: 1,
                limit: 5, // Limita la cantidad de resultados devueltos
            }
        })
    }).on('markgeocode', function(e) {
        const latlng = e.geocode.center;
        L.marker(latlng).addTo(map)
            .bindPopup(e.geocode.name)
            .openPopup();
        map.setView(latlng, 16);
    }).addTo(map);
    });

