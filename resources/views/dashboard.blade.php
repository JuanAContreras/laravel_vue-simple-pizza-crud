@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h4>Lista de Pedidos</h4>
            <pedido-dash></pedido-dash>
            <h4>Lista de Pizzas</h4>
            <pizza-list></pizza-list>
            <h4>Lista de Ingredientes</h4>
            <ingredient-list><ingredient-list>
        </div>
    </div>
</div>
@endsection
