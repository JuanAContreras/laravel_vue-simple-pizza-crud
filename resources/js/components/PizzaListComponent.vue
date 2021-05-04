<template>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Pizza</th>
                <th scope="col">Coste</th>
                <th scope="col">Ingredientes</th>
                <th scope="col">Pedido</th>
                <th scope="col">Fecha</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="pizza in pizzaList" :key="pizza.id">
                <td>{{pizza.id}}</td>
                <td>{{pizza.coste}}€</td>
                <td>{{pizza.ingredientes}}</td>
                <td>{{pizza.pedido}}</td>
                <td>{{pizza.created_at}}</td>
                <td><a class="button" href="#" v-on:click="deletePizza(pizza.id)">Eliminar</a></td>
            </tr>
        </tbody>
    </table>
</template>

<script>
    export default {
        name: 'pizza-dash',
        data() {
            return {
                pizzaList:[],
            };
        },
        mounted() {
            axios.get('http://127.0.0.1:8000/pizza')
            .then((result) => {
                result.data.forEach((pizza) => {
                    this.pizzaList.push({
                        id: pizza.id,
                        pedido: pizza.pedido_id,
                        ingredientes: pizza.ingredientes,
                        coste: pizza.coste / 100,
                        created_at: pizza.created_at
                    });
                });
            });
        },
        methods: {
            deletePizza: function(_id){
                axios.delete('http://127.0.0.1:8000/pizza/' + _id)
                .then(res => {
                    this.pizzaList = this.pizzaList.filter((pizza) => {
                        return pizza.id != _id;
                    });
                })
                .catch(err => console.error(err));
            }
        },
    }
</script>
