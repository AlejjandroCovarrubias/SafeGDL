document.addEventListener("DOMContentLoaded", function () {
    let map = L.map('map').setView([20.659249, -103.325971], 16);
    let startlat = null;
    let startlng = null;
    let graph = {};
    let isCalculatingRoute = false;

    function obtenerCoordenadas() {
        if (navigator.geolocation) {
            navigator.geolocation.watchPosition(function (posicion) {
                const lat = posicion.coords.latitude;
                const lng = posicion.coords.longitude;
                startlat = lat;
                startlng = lng;
                actCoords(lat, lng);
            }, function (error) {
                console.error("ERROR: No localización");
            }, {
                enableHighAccuracy: true,
                timeout: 5000,
                maximumAge: 0
            });
        }
    }

    let marker;

    function actCoords(lat, lng) {
        if (marker) {
            map.removeLayer(marker);
        }

        marker = L.marker([lat, lng]).addTo(map)
            .bindPopup('Estás aquí');
    }

    obtenerCoordenadas();

    const layer = L.tileLayer(`https://api.maptiler.com/maps/streets-v2/{z}/{x}/{y}.png?key=${key}`, {
        tileSize: 512,
        zoomOffset: -1,
        minZoom: 1,
        attribution: "\u003ca href=\"https://www.maptiler.com/copyright/\" target=\"_blank\"\u003e\u0026copy; MapTiler\u003c/a\u003e \u003ca href=\"https://www.openstreetmap.org/copyright\" target=\"_blank\"\u003e\u0026copy; OpenStreetMap contributors\u003c/a\u003e",
        crossOrigin: true
    }).addTo(map);

    let routingControl;

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
    }).on('markgeocode', function (e) {
        const latlng = e.geocode.center;
        L.marker(latlng).addTo(map)
            .bindPopup(e.geocode.name)
            .openPopup();
        map.setView(latlng, 16);

        if (routingControl) {
            map.removeControl(routingControl);
        }

        calcularRuta(latlng);
    }).addTo(map);

    const fetchOSMData = async () => {
        const response = await fetch(`http://overpass-api.de/api/interpreter?data=[out:json];(way["highway"](around:1000, ${startlat}, ${startlng}););out;`);
        const data = await response.json();
        return data;
    };

    const calculateDistance = (element) => {
        return 1; 
    };

    const createGraph = (osmData) => {
        const graph = {};
        osmData.elements.forEach(element => {
            if (element.type === 'way') {
                const nodes = element.nodes;
                const distance = calculateDistance(element);
                for (let i = 0; i < nodes.length - 1; i++) {
                    const from = nodes[i];
                    const to = nodes[i + 1];
                    if (!graph[from]) graph[from] = {};
                    graph[from][to] = distance;
                    if (!graph[to]) graph[to] = {};
                    graph[to][from] = distance;
                }
            }
        });
        return graph;
    };

    const getClosestNode = async (lat, lng) => {
        const overpassUrl = 'http://overpass-api.de/api/interpreter';
        const query = `
            [out:json];
            node(around:80, ${lat}, ${lng});  // Busca nodos dentro de un radio de 50 metros
            out body;`;
        try {
            const response = await axios.get(overpassUrl, {
                params: { data: query }
            });
            const nodes = response.data.elements;
    
            if (nodes.length > 0) {
                const closestNode = nodes[0];
                console.log('Nodo más cercano encontrado:', closestNode);
                return closestNode;
            } else {
                console.log('No se encontraron nodos cercanos.');
                return null;
            }
        } catch (error) {
            console.error('Error al obtener el nodo más cercano:', error);
        }
    };    

    const obtNodos = async (startlat, startlng, end) => {
    const startNode = await getClosestNode(startlat, startlng);
    const endNode = await getClosestNode(end.lat, end.lng);
    return { startNode, endNode }; 
};

async function getCoordinatesFromNodeId(nodeId) {
    try {
        const response = await axios.get(`https://api.openstreetmap.org/api/0.6/node/${nodeId}.json`);
        if (response.data && response.data.elements && response.data.elements.length > 0) {
            const node = response.data.elements[0];
            const coordinates = { lat: node.lat, lng: node.lon };
            console.log(`Coordenadas del nodo ${nodeId}:`, coordinates);
            return coordinates;
        } else {
            console.error(`No se encontraron datos para el nodo con ID ${nodeId}`);
            return null;
        }
    } catch (error) {
        console.error(`Error al obtener los datos del nodo con ID ${nodeId}:`, error);
        return null;
    }
}



    const calcularRuta = async (end) => {
        const { startNode, endNode } = await obtNodos(startlat, startlng, end);
        console.log(startNode.id,endNode.id);
        fetchOSMData().then(osmData => {
            graph = createGraph(osmData);
            const worker = new Worker('/js/worker.js');
            worker.postMessage({ graph, start: startNode });    

            worker.onmessage = function (e) {
                const result = e.data;
                const path = [];
                let currentNode = endNode.id;

                console.log(endNode);
                console.log("Grafo:", graph);
                console.log("El nodo que buscas está en el grafo:", graph.hasOwnProperty(endNode.id));

                console.log("Distancias:", result.distances);
                console.log("Precedentes:", result.previous);

                while (currentNode !== null) {
                    console.log("Nodo actual:", currentNode);
                    if (!(currentNode in result.previous)) {
                        console.error(`El nodo ${currentNode} no se encuentra en previous.`);
                        break;
                    }
                    path.unshift(currentNode);
                    currentNode = result.previous[currentNode];
                }

                const waypoint = Promise.all(path.map(async point => {
                    const coords = await getCoordinatesFromNodeId(point);
                    console.log(coords);
                    return L.latLng(coords.lat, coords.lng);
                }));
                
                routingControl = L.Routing.control({
                    waypoints: waypoint,  // Waypoints ya resueltos
                    routeWhileDragging: true,
                    geocoder: L.Control.Geocoder.nominatim()
                }).addTo(map);
                
                isCalculatingRoute = false;
            };

            worker.onerror = function (error) {
                console.error('Error en Web Worker:');
                console.error('Mensaje:', error.message);
                console.error('Archivo:', error.filename);
                console.error('Línea:', error.lineno);
                console.error('Columna:', error.colno);
                isCalculatingRoute = false;
            };            
        });
    }
});
