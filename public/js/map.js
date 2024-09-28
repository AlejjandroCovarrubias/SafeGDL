// Inicializamos el mapa (falta poner direcciones de forma dinamcia, ahorita pone las de cucei con zoom de 16%)
let map = L.map('map');

function obtenerCoordenadas() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (posicion) {
            const lat = posicion.coords.latitude;
            const lng = posicion.coords.longitude;
            centrarMapa(lat, lng);
        });
    }
}

function centrarMapa(lat, lng) {
    map.setView([lat, lng], 16);
    L.marker([lat, lng]).addTo(map) 
        .bindPopup('Estás aquí')
        .openPopup();
}

obtenerCoordenadas();

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
}).addTo(map);