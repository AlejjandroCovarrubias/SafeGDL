document.addEventListener("DOMContentLoaded", function () {
    
    const map = L.map('map').setView([19.77032, -104.36409], 13); // Coordenadas de París

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap'
    }).addTo(map);

    function getRoute(pointA, pointB) {
        fetch(`/route?pointA=${pointA}&pointB=${pointB}`)
            .then(response => response.json())
            .then(data => {
                if (data.paths && data.paths.length > 0) {
                    const encodedPoints = data.paths[0].points;
                    const decodedPoints = decodePolyline(encodedPoints); 
                    const polyline = L.polyline(decodedPoints, { color: 'blue' }).addTo(map);
                    map.fitBounds(polyline.getBounds()); 
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
    

    // Llama a la función para obtener la ruta
    getRoute('-104.36409,19.77032', '-103.325735,20.656729'); // Coordenadas de ejemplo
});
