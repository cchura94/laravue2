<template>
  <v-container>
    <h1>Lista de Productos</h1>

    <v-dialog v-model="dialog" persistent max-width="600px">
      <template v-slot:activator="{ on, attrs }">
        <v-btn color="primary" dark v-bind="attrs" v-on="on">NUEVO PRODUCTO</v-btn>
      </template>
      <v-card>
        <v-card-title>
          <span class="headline">Datos de Producto</span>
        </v-card-title>
        <v-card-text>
          <v-container>
            <v-row>
              <v-col cols="12" sm="8" md="8">
                <v-text-field label="Ingrese Nombre*" v-model="producto.nombre" required></v-text-field>
              </v-col>
              <v-col cols="12" sm="4" md="4">
                <v-text-field
                  type="number"
                  step="0.01"
                  label="Ingrese Precio*"
                  hint="289.00"
                  required
                  v-model="producto.precio"
                ></v-text-field>
              </v-col>
              <v-col cols="12" sm="12" md="12">
                <v-text-field
                  label="Ingrese detalles del producto"
                  hint="Ingrese detalles del producto"
                  persistent-hint
                  required
                  v-model="producto.detalle"
                ></v-text-field>
              </v-col>
            </v-row>
          </v-container>
          <small>* Indica los campos obligatorios</small>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1" text @click="dialog = false">Close</v-btn>
          <v-btn color="blue darken-1" @click="guardaProducto()" text>Guardar</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

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
  </v-container>
</template>

<script>
import * as servicio from "./../../../services/productoService";

export default {
  data() {
    return {
      productos: [],
      dialog: false,
      producto: {
        nombre: "",
        precio: 0,
        detalle: ""
      }
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
  },
  methods: {
    guardaProducto() {
      servicio
        .guardarProducto(this.producto)
        .then(respuesta => {
          console.log(respuesta);
          if (respuesta.creado == false) {
            console.log(respuesta.errores);
          }
        })
        .catch(error => {
          console.log(respuesta);
        });
    }
  }
};
</script>

<style>
</style>