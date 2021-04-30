<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h4>Ingredientes disponibles</h4>
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Coste</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Queso</td>
                            <td>1,80€</td>
                            <td><a class="button">Añadir</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row justify-content-center">
            <h4>Ingredientes de la pizza</h4>
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Coste</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Queso</td>
                        <td>1,80€</td>
                        <td><a class="button">Añadir</a></td>
                    </tr>
                </tbody>
            </table>
            <form action="">
                <input type="submit" value="Añadir pizza">
            </form>
        </div>
        <div class="row justify-content-center">
            <h4>Resumen del pedido</h4>
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">Pizza</th>
                    <th scope="col">Coste</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>id pizza</td>
                        <td>18,80€</td>
                        <td><a class="button">Eliminar</a></td>
                    </tr>
                </tbody>
            </table>
            <form action="">
                <input type="submit" value="Realizar pedido">
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        name:'pedido-component',
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
