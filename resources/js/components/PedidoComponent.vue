<template>
    <div class="container">
        <div class="col-md-12">
            <div class="row justify-content-center m-1">
                <h4>Ingredientes disponibles</h4>
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Coste</th>
                        <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="ingrediente in ingredientesDisponibles" :key="ingrediente.id">
                            <td>{{ingrediente.nombre}}</td>
                            <td>{{ingrediente.coste.toFixed(2)}} €</td>
                            <td><button v-on:click="addIngredient(ingrediente.id)">Añadir</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row justify-content-center m-1">
            <h4>Ingredientes de la pizza</h4>
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Coste</th>
                    <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="ingrediente in ingredienteSeleccionados" :key="ingrediente.id">
                       <td>{{ingrediente.nombre}}</td>
                            <td>{{ingrediente.coste.toFixed(2)}} €</td>
                            <td><button v-on:click="deleteIngredient(ingrediente.id)">Eliminar</button></td>
                    </tr>
                </tbody>
            </table>
            <div><h4>Coste pizza: {{costePizza.toFixed(2)}} €</h4></div>
            <button style="margin-left:15px;" v-on:click="createPizza()">Añadir pizza</button>
        </div>
        <div class="row justify-content-center m-1">
            <h4>Resumen del pedido</h4>
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">Pizza</th>
                    <th scope="col">Ingredientes</th>
                    <th scope="col">Coste</th>
                    <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="pizza in listaPizza" :key="pizza.id">
                        <td>Pizza {{pizza.id}}</td>
                        <td>{{pizza.ingredientes}}</td>
                        <td>{{pizza.coste.toFixed(2)}} €</td>
                        <td><button style="margin-left:15px;" v-on:click="deletePizza(pizza.id)">Eliminar</button></td>
                    </tr>
                </tbody>
            </table>
            <div><h4>Coste total: {{costeTotal.toFixed(2)}} €</h4></div>

        </div>
        <div class="row justify-content-center m-1">
            <button  v-on:click="createOrder()">Aceptar</button>
            <button v-on:click="cancelOrder()">Cancelar</button>
        </div>
    </div>
</template>

<script>
    export default {
        name:'pedido-component',
        data() {
            return {
                listaPizza:[],
                listaIngredientes:[], //Base ingredient list
                ingredientesDisponibles:[],
                ingredienteSeleccionados:[],
                pedido:[], //pizza = [ingredientes]
                costePizza:0,
                costeTotal:0,
                userId: 0,
            }
        },
        mounted() {
            //Get logged id user
            this.userId = document.querySelector("meta[name='user_id']").getAttribute('content');

            axios.get('http://127.0.0.1:8000/ingrediente')
            .then((response) => {
                response.data.forEach((ing) => {
                    this.listaIngredientes.push({
                        id: ing.id,
                        nombre: ing.Nombre,
                        coste: ing.Coste / 100,
                    });
                });
                this.ingredientesDisponibles = this.listaIngredientes;
            });
        },
        methods: {
            /**
             * Selecciona un nuevo ingrediente para la pizza
             */
            addIngredient: function(_id){
                let ingredienteTemp = this.ingredientesDisponibles.find(element => element.id === _id);
                this.costePizza += ingredienteTemp.coste;

                this.ingredienteSeleccionados.push(ingredienteTemp);
                 this.ingredientesDisponibles = this.ingredientesDisponibles.filter((ingrediente) => {
                        return ingrediente.id != _id;
                    });
            },
            /**
             * Elimina un ingrediente de la selección de la pizza
             */
            deleteIngredient: function(_id){
                let ingredienteTemp = this.ingredienteSeleccionados.find(element => element.id === _id);
                this.costePizza -= ingredienteTemp.coste;

                this.ingredientesDisponibles.push(ingredienteTemp);
                 this.ingredienteSeleccionados = this.ingredienteSeleccionados.filter((ingrediente) => {
                        return ingrediente.id != _id;
                    });

                if (this.ingredienteSeleccionados.length === 0){
                    this.costePizza = 0;
                }
            },
            /**
             * Crea una pizza con los ingredientes seleccionados y limpia la lista de diponibles
             */
            createPizza: function(){
                let pizzaTemp = {
                    id:this.listaPizza.length +1,
                    ingredientes: [],
                    coste: 0
                };
                let pizzaPedidoTemp = [];
                this.ingredienteSeleccionados.forEach((ingrediente) => {
                    pizzaPedidoTemp.push(ingrediente.id);
                    pizzaTemp.ingredientes.push(ingrediente.nombre);
                    pizzaTemp.coste+= ingrediente.coste;
                });
                pizzaTemp.ingredientes = pizzaTemp.ingredientes.join(",");
                this.listaPizza.push(pizzaTemp);
                this.costeTotal += pizzaTemp.coste;

                this.ingredientesDisponibles = this.listaIngredientes;
                this.ingredienteSeleccionados = [];
                this.pedido.push(pizzaPedidoTemp);

                this.costePizza = 0;
            },
            /**
             * Borra una pizza y limpia la lista de disponibles
             */
            deletePizza: function(_id) {
                let pizzaTemp = this.listaPizza.find((pizza) => {
                    return pizza.id == _id;
                });
                this.costeTotal -= pizzaTemp.coste;
                this.listaPizza = this.listaPizza.filter((pizza) => {
                    return pizza.id != _id;
                });
            },
            /**
             * Crea el pedido y muestra el resumen
             */
            createOrder: function() {
                axios.post('http://127.0.0.1:8000/pedido', {user:this.userId, data:this.pedido})
                .then((response) => this.cancelOrder())
                .catch((err) => {
                    console.error(err);
                })
            },
            /**
             * Cancela el pedido y elimina todos los datos.
             */
            cancelOrder: function(){
                this.ingredientesDisponibles = this.listaIngredientes;
                this.ingredienteSeleccionados = [];
                this.listaPizza = [];
                this.costePizza = 0;
                this.costeTotal = 0;
            }
        }
    }
</script>
