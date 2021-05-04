<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\models\Pizza;
use App\Models\Ingrediente;
use App\models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pedidos = Pedido::all();
        $result = array();

        foreach($pedidos as $p){
            $user = User::find($p->user_id);
            $auxPedido = array(
                'id' => $p->id,
                'user' => $user->name.": ".$user->email,
                'pizzas' => [],
                'factura' => 0,
                'created_at' => date('d-m-Y H:i', strtotime($p->created_at)),
            );
            $pizzaList = $p->pizzas()->get();

            // Añadir pizzas y sus costes
            foreach($pizzaList as $pizza){
                $auxPedido['pizzas'][] = $pizza->id;
                $ingredientes = $pizza->ingredientes()->get();

                foreach($ingredientes as $ing){
                    $auxPedido['factura'] += $ing->Coste;
                }
            }

            $auxPedido['pizzas'] = implode(', ', $auxPedido['pizzas']);
            $result[] = $auxPedido;
        }

        return $result;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return "no implementado";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::find($request->user);
        $pedido = $user->pedidos()->create();

        foreach($request->data as $ingredientList){
            $pizza = $pedido->pizzas()->create();
            $pizza->coste = 0;
            foreach($ingredientList as $id_ingrediente){
                $ingrediente = Ingrediente::find($id_ingrediente);
                $pizza->coste += $ingrediente->Coste;
                $pizza->ingredientes()->attach($id_ingrediente);
            }
            $pizza->save();
        }
        $pedido->save();

        return $pedido;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function show(Pedido $pedido)
    {
        return 'no implementado';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function edit(Pedido $pedido)
    {
        return 'no implementado';
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pedido $pedido)
    {
        return 'no implementado';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pedido $pedido)
    {
        return $pedido->delete();
    }
}
