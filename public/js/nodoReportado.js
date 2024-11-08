let map = L.map('mapa_reportar').setView([20.65671835, -103.325310327668], 14)

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

let marker;

const getNodesInBlock = async (lat, lng) => {
    const overpassUrl = 'http://overpass-api.de/api/interpreter';
    const query = `
        [out:json];
        (
        way(around:5, ${lat}, ${lng})["highway"]; // Buscar vías dentro de 5m
        );
        out body;
                            >;
        out skel qt;
        `;

    try {
        const response = await axios.get(overpassUrl, {
            params: { data: query }
        });
        const ways = response.data.elements;

        if (ways.length > 0) {
            console.log('Vías encontradas:', ways);
            return ways; // Aquí tienes todas las vías y sus nodos
        } else {
            console.log('No se encontraron vías cercanas.');
            return null;
        }
    } catch (error) {
        console.error('Error al obtener los nodos:', error);
    }
};

const getClosestNodeInFirstWay = (ways, lat, lng) => {
    if (!ways || ways.length === 0) {
        console.log('No hay vías disponibles.');
        return null;
    }

    // Tomar el primer way
    const firstWay = ways.find(way => way.type === "way");
    console.log(firstWay.nodes)
    if (!firstWay || !firstWay.nodes) {
        console.log('No se encontraron nodos en el primer way.');
        return null;
    }

    // Calcular la distancia entre el marcador y cada nodo del primer way
    let closestNode = null;
    let minDistance = Infinity;

    firstWay.nodes.forEach(node => {
        const distance = Math.sqrt(
            Math.pow(ways.find(nodo => nodo.id === node).lat - lat, 2) + Math.pow(ways.find(nodo => nodo.id === node).lon - lng, 2)
        );

        if (distance < minDistance) {
            minDistance = distance;
            closestNode = node;
        }
    });

    console.log('Nodo más cercano:', closestNode);
    return ways.find(nodo => nodo.id === closestNode);
};

map.on('click', async function (e) {
    const { lat, lng } = e.latlng;

    // Obtener las vías cercanas
    const ways = await getNodesInBlock(lat, lng);

    if (ways && ways.length > 0) {
        // Si hay vías cercanas, coloca el marcador
        if (marker) {
            marker.setLatLng([lat, lng]);
        } else {
            marker = L.marker([lat, lng]).addTo(map);
        }

        console.log('Marcador colocado en:', lat, lng);
    } else {
        // Si no hay vías cercanas, muestra un mensaje o no coloques el marcador
        alert('Por favor, selecciona una ubicación en una calle.');
    }

    // Encontrar el nodo más cercano en el primer way
    const closestNode = getClosestNodeInFirstWay(ways, lat, lng);

    if (closestNode) {
        document.getElementById('latitud').value = closestNode.lat;
        document.getElementById('longitud').value = closestNode.lon;
    } else {
        alert('No se encontró un nodo cercano en las vías.');
    }
});
