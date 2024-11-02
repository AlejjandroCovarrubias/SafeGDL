<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class GraphHopperService
{
    protected $client;
    protected $apiKey;

    public function __construct()
    {
        // Inicializar el cliente de Guzzle
        $this->client = new Client();
        // Obtener la API Key del archivo .env
        $this->apiKey = env('GRAPH_HOPPER_API_KEY');
    }

    /**
     * Calcular la ruta entre dos puntos.
     *
     * @param string $pointA Coordenadas de inicio (lat,lng).
     * @param string $pointB Coordenadas de destino (lat,lng).
     * @return array|mixed
     */
    public function calculateRoute($pointA, $pointB)
    {
        $client = new Client();
        $url = "https://graphhopper.com/api/1/route?point={$pointA}&point={$pointB}&vehicle=car&key=" . env('GRAPH_HOPPER_API_KEY');
        try {
            $response = $response = $client->request('GET', $url);
            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            // Manejo de errores
            return [
                'error' => true,
                'message' => $e->getMessage(),
            ];
        }
    }
}