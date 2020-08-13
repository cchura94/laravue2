<template>
  <div class="container">
    <h1>Página de INICIO</h1>
    <h1 v-if="cargando">Cargando datos desde Laravel...</h1>
    <p>{{ productos }}</p>
    <hr />
    <div class="row">
      <div class="col-md-4" v-for="prod in productos" :key="prod.id">
        <div class="card">
          <img
            src="https://laravel.com/img/logomark.min.svg"
            height="200px"
            class="card-img-top"
            alt="#"
          />
          <div class="card-body">
            <h5 class="card-title">{{prod.nombre}}</h5>
            <p class="card-text">{{ prod.detalle }}</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      productos: [],
      cargando: true
    };
  },
  created() {
    axios
      .get("http://localhost:8000/api/producto")
      .then(datos => {
        console.log(datos.data);
        this.productos = datos.data;
        this.cargando = false;
      })
      .catch(error => {
        console.log(error);
      });
  }
};
</script>

<style></style>
