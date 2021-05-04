<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use Illuminate\Http\Request;

class PizzaController extends Controller
{
    /**
     * Devuelve un listado de las pizzas con su pedido correspondiente y sus ingredientes;
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pizzaList = Pizza::all();
        $result = array();

        foreach($pizzaList as $pizza){
            $p = array();
            $p['id'] = $pizza->id;
            $p['pedido_id'] = $pizza->pedido_id;
            $p['ingredientes'] = array();
            $p['coste'] = 0;
            $p['created_at'] = date('d-m-Y H:i', strtotime($pizza->created_at));

            $ingredientes = $pizza->ingredientes()->get();
            foreach($ingredientes as $ing){
                $p['ingredientes'][] = $ing->Nombre;
                $p['coste']+=$ing->Coste;
            }
            $p['ingredientes'] = implode(', ', $p['ingredientes']);
            $result[] = $p;
        }

        return $result;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return "No implementado";
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pizza  $pizza
     * @return \Illuminate\Http\Response
     */
    public function show(Pizza $pizza)
    {
        return "No implementado";
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pizza  $pizza
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pizza $pizza)
    {
        return "No implementado";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pizza  $pizza
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pizza $pizza)
    {
        return Pizza::destroy($pizza->id);
    }
}
