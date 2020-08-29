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
          <v-col cols="6" v-for="(prod, index) in productos" :key="index">
            <v-card color="#a80F73" dark elevation="10">
              <div class="d-flex flex-no-wrap justify-space-between">
                <div>
                  <v-card-title class="headline" v-text="prod.nombre"></v-card-title>

                  <v-card-subtitle v-text="prod.precio"></v-card-subtitle>
                </div>

                <v-avatar class="ma-3" size="125" tile v-if="prod.imagen">
                  <v-img :src="`//localhost:8000${prod.imagen}`"></v-img>
                </v-avatar>
              </div>

              <v-card-actions>
                <v-btn text @click="agregarCarrito(prod)">add carrito</v-btn>
              </v-card-actions>
            </v-card>
          </v-col>
        </v-row>
      </v-col>
      <v-col cols="4">
        <h2>Productos seleccionados</h2>

        <v-card color="#880F33" dark elevation="10">
          <v-card-title class="headline">Total a Cobrar:</v-card-title>
          <v-row>
            <h5>{{ calcular_total }}</h5>
            <v-spacer></v-spacer>
            <v-btn @click="terminarVenta()">Cobrar</v-btn>
          </v-row>
        </v-card>

        <v-col v-for="(item, i) in carrito" :key="i" cols="12">
          <v-card :color="`#ff9800`" dark>
            <div class="d-flex flex-no-wrap justify-space-between">
              <div>
                <v-card-title class="headline" v-text="item.nombre"></v-card-title>

                <v-card-subtitle v-text="item.precio"></v-card-subtitle>
              </div>

              <v-btn @click="incrementar(item)">+</v-btn>
              <v-btn>{{ item.cantidad }}</v-btn>
              <v-btn @click="decrementar(item)">-</v-btn>
            </div>
          </v-card>
        </v-col>
      </v-col>
    </v-row>
  </div>
</template>

<script>
import axios from "axios";
import { base_url, getHeader } from "./../../../config/config";
import * as productoService from "./../../../services/productoService";
import * as pedidoService from "./../../../services/pedidoService";
import { jsPDF } from "jspdf";

export default {
  data() {
    return {
      id: 0,
      cliente: {},
      productos: [],
      total: 0,
      carrito: []
    };
  },
  computed: {
    calcular_total() {
      return "Bs. " + this.total;
    }
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
  },
  methods: {
    agregarCarrito(prod) {
      console.log(this.buscar(prod));
      if (this.buscar(prod)) {
        alert("El producto ya esta en el carrito");
      } else {
        var pedido = {
          id: prod.id,
          nombre: prod.nombre,
          precio: prod.precio,
          cantidad: 1
        };
        this.carrito.push(pedido);
        this.total += parseFloat(prod.precio);
      }
    },
    buscar(prod) {
      var cont = 0;
      this.carrito.forEach(p => {
        console.log(p, " **** ", prod);
        if (p.id == prod.id) {
          cont++;
        }
      });
      if (cont > 0) {
        return true;
      }
      return false;
    },
    incrementar(item) {
      item.cantidad++;
      this.total += parseFloat(item.precio);
    },
    decrementar(item) {
      if (item.cantidad != 1) {
        item.cantidad--;
        this.total -= parseFloat(item.precio);
      }
    },
    terminarVenta() {
      var productos = [];
      for (let i = 0; i < this.carrito.length; i++) {
        const ped = this.carrito[i];
        productos.push(ped.id);
      }

      var datos = {
        cliente_id: this.id,
        monto_total: this.total,
        productos: productos
      };
      pedidoService
        .guardarPedido(datos)
        .then(respuesta => {
          console.log(respuesta);
          const doc = new jsPDF();

          doc.text(" Nuevo Pedido", 70, 15);
          doc.text(
            `Cliente: ${this.cliente.nombres} ${this.cliente.apellidos}`,
            10,
            25
          );
          doc.save("nuevo_pedido.pdf");
        })
        .catch(error => {
          console.log(error);
        });
    }
  }
};
</script>

<style>
</style>