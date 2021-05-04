<template>
    <div class="container">
        <form v-on:submit.prevent="agregarIngrediente">
            <input type="text" placeholder="Nombre" v-model="nIngrediente">
            <input type="number" placeholder="Coste" v-model="cIngrediente">
            <input type="submit" value="Agregar">
        </form>
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
            axios.get('http://127.0.0.1:8000/ingrediente')
            .then((response) => {
                response.data.forEach((ing) => {
                    this.listaIngredientes.push({
                        id: ing.id,
                        nombre: ing.Nombre,
                        coste: ing.Coste,
                    });
                });
            });
        },
        methods: {
            agregarIngrediente: function() {
                 axios.post('http://127.0.0.1:8000/ingrediente', {
                    nombre: this.nIngrediente,
                    coste: this.cIngrediente
                })
                .then(res => {
                    console.log(res);
                    this.listaIngredientes.push({
                        id: res.data.id,
                        nombre: res.data.Nombre,
                        coste: res.data.Coste
                    });
                    this.nIngrediente = "";
                    this.cIngrediente = 0;
                }).catch(err => console.error(err));
            },
            deleteIngrediente: function(_id){
                axios.delete('http://127.0.0.1:8000/ingrediente/' + _id)
                .then(res => {
                    this.listaIngredientes = this.listaIngredientes.filter((ingrediente) => {
                        return ingrediente.id != _id;
                    });
                })
                .catch(err => console.error(err));
            }
        }
    }
</script>
