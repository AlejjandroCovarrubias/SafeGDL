<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
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

        $customModel = [
            'speed' => [],
            'areas' => [
                'type' => 'FeatureCollection',
                'features' => []
            ]
        ];
        
        /**
         * POR CADA REPORTE - 10%
         * SI SON > DE 10 REPORTES, DIRECTAMENTE 0
         */

        $bannedAreas = [
            [-104.360123, 19.771217, 0.5],
            [-104.360273, 19.771459, 1],
            [-104.360383, 19.771843, 0.9],
            [-104.360123, 19.770495, 0.4],
            [-104.361856, 19.770318, 0.2],
            [-104.361856, 19.770318, 0.2]
        ];

        foreach ($bannedAreas as $index => $coordinates) {
            $customModel['speed'][] = [
                'if' => "in_custom{$index}",
                'multiply_by' => $coordinates[2]
            ];
    
            $customModel['areas']['features'][] = [
                'type' => 'Feature',
                'id' => "custom{$index}",
                'geometry' => [
                    'type' => 'Polygon',
                    'coordinates' => [
                        [
                            [$coordinates[0], $coordinates[1]],
                            [$coordinates[0] + 0.005, $coordinates[1]], 
                            [$coordinates[0] + 0.005, $coordinates[1] + 0.005],
                            [$coordinates[0], $coordinates[1] + 0.005], 
                            [$coordinates[0], $coordinates[1]]
                        ]
                    ],
                ],
            ];
        }

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post('https://graphhopper.com/api/1/route?key=c0fbc711-8aed-46f6-a9d9-e716549382a5', [
            'profile' => 'foot',
            'points' => [
                explode(',', $pointA),
                explode(',', $pointB)
            ],
            'ch.disable' => true,
            'custom_model' => $customModel
        ]);
        
        return $response->json();
    }
}