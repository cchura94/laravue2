<template>
  <div class="container">
    <h1>Página de INICIO</h1>
    <h1 v-if="cargando">Cargando datos desde Laravel...</h1>
    <hr />

    <!-- Button trigger modal -->
    <button
      type="button"
      class="btn btn-primary"
      data-toggle="modal"
      data-target="#exampleModal"
    >Nuevo Producto</button>

    <!-- Modal -->
    <div
      class="modal fade"
      id="exampleModal"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <label for>Ingrese Nombre</label>
            <input type="text" class="form-control" v-model="producto.nombre" />
            <label for>Ingrese Precio</label>
            <input type="text" class="form-control" v-model="producto.precio" />
            <label for>Ingrese Descripción</label>
            <textarea class="form-control" v-model="producto.detalle"></textarea>
            {{ producto }}
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button
              type="button"
              class="btn btn-primary"
              @click="guardarProducto()"
            >Guardar Producto</button>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-4" v-for="(prod, index) in productos" :key="index">
        <div class="card">
          <img
            src="https://laravel.com/img/logomark.min.svg"
            height="200px"
            class="card-img-top"
            alt="#"
          />
          <div class="card-body">
            <h5 class="card-title">{{ prod.nombre }}</h5>
            <p class="card-text">{{ prod.detalle }}</p>
            <a href="#" class="btn btn-danger" @click="eliminarProducto(prod.id)">x</a>
          </div>
        </div>
      </div>
    </div>

    <v-container>
      <v-row>
        <v-col v-for="(prod, index) in productos" :key="index" cols="4">
          <v-card>
            <v-img
              src="https://laravel.com/img/logomark.min.svg"
              class="white--text align-end"
              gradient="to bottom, rgba(0,0,0,.1), rgba(0,0,0,.5)"
              height="200px"
            >
              <v-card-title v-text="prod.nombre"></v-card-title>
            </v-img>

            <v-card-actions>
              <v-spacer></v-spacer>

              <v-btn icon>
                <v-icon>mdi-heart</v-icon>
              </v-btn>

              <v-btn icon>
                <v-icon>mdi-bookmark</v-icon>
              </v-btn>

              <v-btn icon>
                <v-icon>mdi-share-variant</v-icon>
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
import axios from "axios";

import { http } from "./../services/api";

export default {
  data() {
    return {
      productos: [],
      cargando: true,
      producto: {
        nombre: "",
        precio: 0.0,
        detalle: ""
      }
    };
  },
  created() {
    http()
      .get("http://localhost:8000/api/producto")
      .then(datos => {
        console.log(datos.data);
        this.productos = datos.data;
        this.cargando = false;
      })
      .catch(error => {
        console.log(error);
      });
  },
  methods: {
    guardarProducto() {
      axios
        .post("http://localhost:8000/api/producto", this.producto)
        .then(respuesta => {
          this.productos.push(this.producto);
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    eliminarProducto(id) {
      axios
        .delete("http://localhost:8000/api/producto/" + id)
        .then(respuesta => {
          console.log(respuesta);
        })
        .catch(function(error) {
          console.log(error);
        });
    }
  }
};
</script>

<style></style>
