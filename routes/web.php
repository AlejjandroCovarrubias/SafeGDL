<?php

use App\Http\Controllers\DelitoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('delito.bienvenida');
});

Route::get('/mapa', function () {
    return view('testing');
});

Route::resource('delito', DelitoController::class);


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
