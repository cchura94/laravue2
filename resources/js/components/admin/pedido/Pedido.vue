<template>
  <div>
    <h1>Nuevo Pedidos</h1>
    <v-row>
      <v-col cols="12">
        <v-card color="#385F73" dark>
          <v-card-title class="headline">Datos de Cliente</v-card-title>

          <v-card-subtitle>
            Nombre Cliente:
            {{ cliente.nombres }} {{ cliente.apellidos }}
            <hr />
            CI / NIT:
            {{ cliente.ci_nit }}
            <hr />
            CORREO:
            {{ cliente.correo }}
          </v-card-subtitle>
        </v-card>
      </v-col>
    </v-row>
    <v-row>
      <v-col cols="8">
        <h2>Lista de Productos</h2>
        <v-row>
          <v-col cols="4" v-for="(prod, index) in productos" :key="index">
            <v-card color="#a80F73" dark elevation="10">
              <v-img :src="`//localhost:8000${prod.imagen}`" height="250"></v-img>
              <v-card-title class="headline">{{ prod.nombre }}</v-card-title>
            </v-card>
          </v-col>
        </v-row>
      </v-col>
      <v-col cols="4">
        <h2>Productos seleccionados</h2>
      </v-col>
    </v-row>
  </div>
</template>

<script>
import axios from "axios";
import { base_url, getHeader } from "./../../../config/config";
import * as productoService from "./../../../services/productoService";
import { jsPDF } from "jspdf";

export default {
  data() {
    return {
      id: 0,
      cliente: {},
      productos: []
    };
  },
  created() {
    this.id = this.$route.params.id;
    axios
      .get(base_url + "/cliente/" + this.id, { headers: getHeader() })
      .then(respuesta => {
        this.cliente = respuesta.data;
      });

    productoService
      .listarProductos()
      .then(respuesta => {
        this.productos = respuesta;
      })
      .catch(error => {
        localStorage.clear();
        this.$router.push({ name: "Login" });
      });

    // Default export is a4 paper, portrait, using millimeters for units
    const doc = new jsPDF();

    doc.text("Hola Mundo", 10, 50);
    doc.save("a4.pdf");
  }
};
</script>

<style>
</style>