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

    public function getRoute(Request $request)
    {
        $pointA = $request->query('pointA');
        $pointB = $request->query('pointB');

        $route = $this->graphHopperService->calculateRoute($pointA, $pointB);

        return response()->json($route);
    }
}
