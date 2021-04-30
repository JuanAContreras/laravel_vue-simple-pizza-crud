<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="container" v-if="isDash()">
                    <form v-on:submit.prevent="agregarIngrediente">
                        <input type="text" placeholder="Nombre" v-model="nIngrediente">
                        <input type="number" placeholder="Coste" v-model="cIngrediente">
                        <input type="submit" value="Agregar">
                    </form>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Coste</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="ingrediente in listaIngredientes" :key="ingrediente.id">
                            <td>{{ingrediente.nombre}}</td>
                            <td>{{ingrediente.coste}}</td>
                            <td><a class="button" href="#" v-on:click="deleteIngrediente(ingrediente.id)">Eliminar</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'ingredient-list',
        data() {
            return {
                nIngrediente: '',
                cIngrediente: 0,
                listaIngredientes: [],
                listaPizzas: [],
                listaPedidos: [],
            }
        },
        mounted() {
            console.log('Component mounted.')

            axios.get('http://127.0.0.1:8000/ingrediente')
            .then((response) => {
                response.data.forEach((ingrediente) => {
                    this.listaIngredientes.push({
                        id: ingrediente.id,
                        nombre: ingrediente.Nombre,
                        coste: ingrediente.Coste
                    })
                });
            })
        },
        methods: {
            isDash(){
                return document.URL.includes('dashboard');
            },
            agregarIngrediente: function() {
                axios.post('http://127.0.0.1:8000/ingrediente', {
                    nombre: this.nIngrediente,
                    coste: this.cIngrediente
                })
                .then(res => {
                    this.listaIngredientes.add({
                        id: res.id,
                        nombre: res.Nombre,
                        coste: res.Coste
                    });
                }).catch(err => console.error(err));
            },
            deleteIngrediente: function(_id){
                axios.delete('http://127.0.0.1:8000/ingrediente/' + _id)
                .then(res => {
                    this.listaIngredientes = this.listaIngredientes.filter((ingrediente) => {
                        ingrediente.id != _id;
                    });
                })
                .catch(err => console.error(err));
            }
        }
    }
</script>
