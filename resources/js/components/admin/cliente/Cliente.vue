<template>
  <div>
    <h1>Lista e CLientes</h1>
    <hr />
    <hr />

    <label for>Seleccionar El Pais</label>
    <v-select :items="paises"></v-select>
    <ul>
      <li v-for="(p, index) in paises" :key="index" :value="p.id">{{p.nombre}}</li>
    </ul>
  </div>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      pais: 0,
      paises: []
    };
  },
  created() {
    axios.get("http://localhost:8000/api/pais").then(datos => {
      this.paises = datos.data;
      console.log(this.paises);
    });
  }
};
</script>

<style>
</style>