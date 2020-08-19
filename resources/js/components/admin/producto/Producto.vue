<template>
  <div>
    <h1>Lista de Productos</h1>
    <v-simple-table>
      <template v-slot:default>
        <thead>
          <tr>
            <th class="text-left">Nombre</th>
            <th class="text-left">Precio</th>
            <th class="text-left">Detalle</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(item, index) in productos" :key="index">
            <td>{{ item.nombre }}</td>
            <td>{{ item.precio }}</td>
            <td>{{ item.detalle }}</td>
          </tr>
        </tbody>
      </template>
    </v-simple-table>
  </div>
</template>

<script>
import * as servicio from "./../../../services/productoService";

export default {
  data() {
    return {
      productos: []
    };
  },
  async created() {
    try {
      this.productos = await servicio.listarProductos();
    } catch (error) {
      console.log(error);
    }

    /*listarProductos()
      .then(respuesta => {
        this.productos = respuesta;
      })
      .catch(error => {
        console.log(error);
      });*/

    /*http()
      .get("/producto")
      .then(datos => {
        this.productos = datos.data;
        console.log(datos);
      })
      .catch(error => {
        console.log(error);
      });*/
  }
};
</script>

<style>
</style>