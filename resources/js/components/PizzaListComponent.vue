<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Pizza</th>
                            <th scope="col">Cliente</th>
                            <th scope="col">Ingredientes</th>
                            <th scope="col">Coste</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Juan</td>
                            <td>a,b,c,d</td>
                            <td>21,80€</td>
                            <td><a class="button">Eliminar</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'pizza-list',
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
