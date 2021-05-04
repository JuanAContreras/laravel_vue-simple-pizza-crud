<?php

namespace App\Http\Controllers;

use App\Models\Ingrediente;
use Illuminate\Http\Request;

class IngredienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Ingrediente::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ingrediente = new Ingrediente();

        $ingrediente->Nombre = $request->nombre;
        $ingrediente->Coste = $request->coste;

        $ingrediente->save();

        return $ingrediente;
    }

    /**
     * Create a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $ingrediente = new Ingrediente();

        $ingrediente->Nombre = $request->nombre;
        $ingrediente->Coste = $request->coste;

        $ingrediente->save();

        return $ingrediente;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ingrediente  $ingrediente
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        return Ingrediente::FindOrFail($request->id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ingrediente  $ingrediente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $ingrediente = Ingrediente::FindOrFail($request->id);

        $ingrediente->Nombre = $request->nombre;
        $ingrediente->Coste = $request->coste;

        $ingrediente->save();
    }

    /**
     * edit the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ingrediente  $ingrediente
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $ingrediente = Ingrediente::FindOrFail($request->id);

        $ingrediente->Nombre = $request->nombre;
        $ingrediente->Coste = $request->coste;

        $ingrediente->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ingrediente  $ingrediente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ingrediente $ingrediente)
    {
        return $ingrediente->delete();
    }
}
