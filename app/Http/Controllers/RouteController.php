<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Services\GraphHopperService;
use Illuminate\Support\Facades\Storage;

class RouteController extends Controller
{
    protected $graphHopperService;

    public function __construct(GraphHopperService $graphHopperService)
    {
        $this->graphHopperService = $graphHopperService;
    }

    public function generateGeoJson()
    {
        // Definir las coordenadas de la autopista Guadalajara - Colima
        $coordinates = [
            [-103.7220, 19.2281], // Coordenadas del nodo 1 (Inicio)
            [-103.6000, 19.3000], // Coordenadas del nodo 2 (Intermedio)
            [-103.5000, 19.5000], // Coordenadas del nodo 3 (Otro Intermedio)
            [-103.4052, 20.6764]  // Coordenadas del nodo 4 (Fin)
        ];

        // Estructura del GeoJSON
        $geoJson = [
            'type' => 'FeatureCollection',
            'features' => [
                [
                    'type' => 'Feature',
                    'properties' => [
                        'penalty' => 2.0 // Duplicar el peso
                    ],
                    'geometry' => [
                        'type' => 'LineString',
                        'coordinates' => $coordinates,
                    ]
                ]
            ]
        ];

        $geoJsonString = json_encode($geoJson, JSON_PRETTY_PRINT);

        Storage::disk('local')->put('geojson/autopista_guadalajara_colima.geojson', $geoJsonString);

        return response()->json(['message' => 'Archivo GeoJSON creado exitosamente.']);
    }

    public function getRoute(Request $request)
    {
        // Obtener los puntos desde la solicitud
        $pointA = $request->query('pointA');
        $pointB = $request->query('pointB');

        // Usar el servicio para calcular la ruta
        $route = $this->graphHopperService->calculateRoute($pointA, $pointB);

        return response()->json($route);
    }
}
