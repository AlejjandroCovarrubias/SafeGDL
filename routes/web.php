<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\DelitoController;

Route::get('/', function () {
    return view('testing');
});

Route::resource('delito', DelitoController::class);

Route::get('/route', [RouteController::class, 'getRoute']);

Route::get('/generate-geojson', [RouteController::class, 'generateGeoJson']);

Route::get('/map', function () {
    return view('map.show');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
