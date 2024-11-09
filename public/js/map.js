document.addEventListener("DOMContentLoaded", function () {
    let map;
    let userMarker;
    let lat_og;
    let lon_og;
    let geocoder;
    let firstTime = true;
    let lastRoute = null;

    function initMap(userLocation) {
        map = L.map('map').setView([userLocation.lat_og, userLocation.lon_og], 13); 
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap'
        }).addTo(map);

        userMarker = L.marker([userLocation.lat_og, userLocation.lon_og]).addTo(map)
            .bindPopup('Estás aquí')
            .openPopup();

        onMapReady();
    }

    function onMapReady() {
        geocoder = L.Control.geocoder().addTo(map);
        
        geocoder.on('markgeocode', function(e) {
            const latLng = e.geocode.center;
            console.log('Coordenadas de búsqueda:', latLng);
            const pointA = `${latLng.lng},${latLng.lat}`; 
            const pointB = `${lon_og},${lat_og}`;
            
            getRoute(pointA, pointB);
        });
    }

    function updateLocation(position) {
        lat_og = position.coords.latitude;
        lon_og = position.coords.longitude;
        userMarker.setLatLng([lat_og, lon_og]);

        if (firstTime) {
            map.setView([lat_og, lon_og], 13);
            firstTime = false;
        }

        console.log("Ubicación del usuario actualizada: " + lat_og + ", " + lon_og);
    }

    function startTracking() {
        if (navigator.geolocation) {
            navigator.geolocation.watchPosition(function(position) {
                if (!map) {
                    lat_og = position.coords.latitude;
                    lon_og = position.coords.longitude;
                    initMap({ lat_og, lon_og });
                }
                updateLocation(position);
            }, function(error) {
                console.error("Error al obtener la ubicación: " + error.message);
            }, {
                enableHighAccuracy: true,
                timeout: 10000,
                maximumAge: 0
            });
        } else {
            console.error("Geolocalización no es soportada por este navegador.");
        }
    }

    startTracking();

    function getRoute(pointA, pointB) {
        fetch(`/route?pointA=${pointA}&pointB=${pointB}`)
            .then(response => response.json())
            .then(data => {
                if (data.paths && data.paths.length > 0) {
                    const encodedPoints = data.paths[0].points;
                    const decodedPoints = decodePolyline(encodedPoints);
                    if (lastRoute) {
                        map.removeLayer(lastRoute);
                    }
                    lastRoute = L.polyline(decodedPoints, { color: 'blue' }).addTo(map);
                    map.fitBounds(lastRoute.getBounds());
                } else {
                    alert('No se encontró ninguna ruta.');
                }
            })
            .catch(error => console.error('Error al obtener la ruta:', error));
    }

    function decodePolyline(encoded) {
        let index = 0, lat = 0, lng = 0;
        const coords = [];

        while (index < encoded.length) {
            let b, result = 0, shift = 0;
            do {
                b = encoded.charCodeAt(index++) - 63;
                result |= (b & 0x1f) << shift;
                shift += 5;
            } while (b >= 0x20);
            const dlat = ((result >> 1) ^ -(result & 1));
            lat += dlat;

            shift = 0;
            result = 0;
            do {
                b = encoded.charCodeAt(index++) - 63;
                result |= (b & 0x1f) << shift;
                shift += 5;
            } while (b >= 0x20);
            const dlng = ((result >> 1) ^ -(result & 1));
            lng += dlng;

            coords.push([lat / 1E5, lng / 1E5]);
        }
        return coords;
    }
});
