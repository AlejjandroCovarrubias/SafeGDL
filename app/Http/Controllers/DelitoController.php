<?php

namespace App\Http\Controllers;

use App\Models\Delito;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class DelitoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $delitos= Delito::all();
        return view('delito.index', compact('delitos'));
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

       // dd($request->all());

        $request->validate([
            'tipoDelito'=>'required|string|max:255',
            'descripcion'=>'required|string',
            'fecha'=>'required|date',
            'latitud'=>'required|regex:/^-?\d{1,3}\.\d+$/',
            'longitud'=>'required|regex:/^-?\d{1,3}\.\d+$/',
        ]);

        $request->merge(['user_id' => Auth::id()]);
        Delito::create($request->all());
        
        return view('testing');
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
