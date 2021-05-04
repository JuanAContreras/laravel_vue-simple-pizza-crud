<template>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Pedido</th>
                <th scope="col">User</th>
                <th scope="col">Coste</th>
                <th scope="col">Pizzas</th>
                <th scope="col">Fecha</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="pedido in pedidoList" :key="pedido.id">
                <td>{{pedido.id}}</td>
                <td>{{pedido.user}}</td>
                <td>{{pedido.coste}}</td>
                <td>{{pedido.pizzas}}</td>
                <td>{{pedido.created_at}}</td>
                <td><a class="button" href="#" v-on:click="deletePedido(pedido.id)">Eliminar</a></td>
            </tr>
        </tbody>
    </table>
</template>

<script>
    export default {
        name: 'pedido-dash',
        data() {
            return {
                pedidoList:[],
            };
        },
        mounted() {
            console.log('Component mounted.')

            axios.get('http://127.0.0.1:8000/pedido')
            .then((result) => {
                result.data.forEach((pedido) => {
                    this.pedidoList.push({
                        id: pedido.id,
                        user: pedido.user,
                        pizzas: pedido.pizzas,
                        factura: pedido.factura,
                        created_at: pedido.created_at,
                    });
                });

                console.log(this.pedidoList);
            });
        },
        methods: {
            deletePedido: function(_id){
                axios.delete('http://127.0.0.1:8000/pedido/' + _id)
                .then(res => {
                    this.pedidoList = this.pedidoList.filter((pedido) => {
                        return pedido.id != _id;
                    });
                })
                .catch(err => console.error(err));
            }
        }
    }
</script>
