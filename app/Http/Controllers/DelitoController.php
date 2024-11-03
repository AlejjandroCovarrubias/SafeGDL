<?php

namespace App\Http\Controllers;

use App\Models\Delito;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class DelitoController extends Controller
{
    /**
     * Display a listing of the resource.
    */

    public function index()
    {
        $delitos= Auth::user()->delito;  
        return view('delito.index', compact('delitos'));
    }

    public function mostrarTodosLosDelitos()
    {
        $delitos = Delito::with('user')->get();
        return view('moderador.VistaMod', compact('delitos'));
    }
    


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('delito.formulario');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tipoDelito'=>'required|string|max:255',
            'descripcion'=>'required|string',
            'fecha'=>'required|date',
            'latitud'=>'required|regex:/^-?\d{1,3}\.\d+$/',
            'longitud'=>'required|regex:/^-?\d{1,3}\.\d+$/',
        ]);

        if(Auth::user())
        {
            $delito = new Delito();

            $delito->user_id = Auth::id();
            $delito->tipoDelito = $request->tipoDelito;
            $delito->descripcion = $request->descripcion;
            $delito->fecha = $request->fecha;
            $delito->latitud = $request->latitud;
            $delito->longitud = $request->longitud;

            $delito->save();

            return redirect()->action([DelitoController::class, 'index']);
        }
        
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Delito $delito)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Delito $delito)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Delito $delito)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Delito $delito)
    {
        //
    }
}
