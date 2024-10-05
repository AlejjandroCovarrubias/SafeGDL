self.onmessage = function (e) {
    console.log("entre");
    console.log('Worker message received:', e.data); // Loga el mensaje recibido
    const { graph, start } = e.data; // Asegúrate de desestructurar correctamente
    const result = dijkstra(graph, start); // Llama a la función dijkstra
    self.postMessage(result);
};

function dijkstra(graph, start) {
    console.log('Graph:', graph);
    console.log('Start:', start);
    const distances = {};
    const previous = {};
    const queue = new PriorityQueue();

    for (let vertex in graph) {
        distances[vertex] = Infinity;
        previous[vertex] = null;
        queue.enqueue(vertex, Infinity);
        console.log("primer for");
    }
    distances[start] = 0;
    queue.enqueue(start, 0);

    while (!queue.isEmpty()) {
        const currentVertex = queue.dequeue().element;
        console.log("segundo for");
        for (let neighbor in graph[currentVertex]) {
            const alt = distances[currentVertex] + graph[currentVertex][neighbor];
            if (alt < distances[neighbor]) {
                distances[neighbor] = alt;
                previous[neighbor] = currentVertex;
                queue.enqueue(neighbor, alt);
            }
        }
    }
    console.log("terminamos")
    return { distances, previous };
}

class PriorityQueue {
    constructor() {
        this.items = [];
    }

    enqueue(element, priority) {
        const queueElement = { element, priority };
        this.items.push(queueElement);
        this.items.sort((a, b) => a.priority - b.priority);
    }

    dequeue() {
        return this.items.shift();
    }

    isEmpty() {
        return this.items.length === 0;
    }
}
