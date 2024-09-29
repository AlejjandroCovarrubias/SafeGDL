<?php

namespace App\Http\Controllers;

use App\Models\Delito;
use Illuminate\Http\Request;

class DelitoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('delito.formulario');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
