<template>
  <div>
    <h1>Lista e CLientes</h1>
    <hr />
    <hr />

    <label>Seleccionar El Pais</label>
    <v-select
      :items="paises"
      item-text="nombre"
      item-value="id"
      v-model="pais_id"
      @change="consultarCiudades"
    ></v-select>
    <h5>Pais seleccionado: {{ pais_id }}</h5>

    <label>Seleccionar Ciudad:</label>
    <v-select
      :items="ciudades"
      item-text="nombre"
      item-value="id"
      v-model="ciudad_id"
      @change="consultarMunicipio()"
    ></v-select>

    <h5>Ciudad seleccionado: {{ ciudad_id }}</h5>

    <label>Seleccionar Municipio:</label>
    <v-select
      :items="municipios"
      item-text="nombre"
      item-value="id"
      v-model="municipio_id"
      :disabled="estado"
    ></v-select>

    <hr />
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
      paises: [],
      pais_id: -1,

      ciudad_id: -1,
      ciudades: [],
      municipios: [],
      municipio_id: -1,
      estado: true
    };
  },
  created() {
    axios.get("http://localhost:8000/api/pais").then(datos => {
      this.paises = datos.data;
      console.log(this.paises);
    });
  },
  methods: {
    consultarCiudades() {
      this.resetCiudades();
      axios
        .get("http://localhost:8000/api/pais/" + this.pais_id)
        .then(datos => {
          this.ciudades = datos.data;
          console.log(this.ciudades);
        });
    },
    consultarMunicipio() {
      axios
        .get("http://localhost:8000/api/ciudad/" + this.ciudad_id)
        .then(datos => {
          this.municipios = datos.data;
          console.log(this.municipios);
          this.estado = false;
        });
    },
    resetCiudades() {
      this.ciudad_id = null;
      this.ciudades = [];
      this.municipios = [];
      this.municipio_id = null;
      this.estado = true;
    }
  }
};
</script>

<style>
</style>