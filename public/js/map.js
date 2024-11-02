document.addEventListener("DOMContentLoaded", function () {
    // Inicializa el mapa centrado en un punto
    const map = L.map('map').setView([19.77032, -104.36409], 13); // Coordenadas de París

    // Capa de OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap'
    }).addTo(map);

    // Función para obtener la ruta
    function getRoute(pointA, pointB) {
        fetch(`/route?pointA=${pointA}&pointB=${pointB}`)
            .then(response => response.json())
            .then(data => {
                if (data.paths && data.paths.length > 0) {
                    // Decodificar los puntos
                    const encodedPoints = data.paths[0].points;
                    const decodedPoints = decodePolyline(encodedPoints); // Usar la función para decodificar
                    
                    // Dibuja la ruta en el mapa
                    const polyline = L.polyline(decodedPoints, { color: 'blue' }).addTo(map);
                    map.fitBounds(polyline.getBounds()); // Ajustar el mapa a la ruta
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
                b = encoded.charCodeAt(index++) - 63; // Convertir a número
                result |= (b & 0x1f) << shift; // Obtener el valor
                shift += 5;
            } while (b >= 0x20);
            const dlat = ((result >> 1) ^ -(result & 1)); // Aplicar bitwise
            lat += dlat; // Sumar latitud
    
            shift = 0;
            result = 0;
            do {
                b = encoded.charCodeAt(index++) - 63;
                result |= (b & 0x1f) << shift;
                shift += 5;
            } while (b >= 0x20);
            const dlng = ((result >> 1) ^ -(result & 1)); // Aplicar bitwise
            lng += dlng; // Sumar longitud
    
            coords.push([lat / 1E5, lng / 1E5]); // Guardar coordenadas
        }
        return coords;
    }
    

    // Llama a la función para obtener la ruta
    getRoute('19.77032,-104.36409', '20.656729,-103.325735'); // Coordenadas de ejemplo
});
