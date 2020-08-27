<template>
  <v-app id="inspire">
    <v-main>
      <v-container class="fill-height" fluid>
        <v-row align="center" justify="center">
          <v-col cols="12" sm="8" md="4">
            <v-card class="elevation-12">
              <v-toolbar color="primary" dark flat>
                <v-toolbar-title>Inicio Sesion</v-toolbar-title>
                <v-spacer></v-spacer>
              </v-toolbar>
              <v-card-text>
                <v-form>
                  <v-text-field
                    label="Correo"
                    v-model="usuario.email"
                    name="login"
                    prepend-icon="mdi-account"
                    type="text"
                  ></v-text-field>

                  <v-text-field
                    id="password"
                    label="Contraseña"
                    v-model="usuario.password"
                    name="password"
                    prepend-icon="mdi-lock"
                    type="password"
                  ></v-text-field>
                </v-form>
                {{ usuario }}
              </v-card-text>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="primary" @click="ingresar">Ingresar</v-btn>
              </v-card-actions>
            </v-card>
          </v-col>
        </v-row>
      </v-container>
    </v-main>
  </v-app>
</template>

<script>
import axios from "axios";
import { base_url } from "./../config/config";
import Swal from "sweetalert2";
export default {
  data() {
    return {
      usuario: {}
    };
  },
  methods: {
    ingresar() {
      axios
        .post(base_url + "/auth/login", this.usuario)
        .then(respuesta => {
          console.log(respuesta.data);
          localStorage.setItem("token", btoa(JSON.stringify(respuesta.data)));
          Swal.fire("Bienvenido", "Aceptar", "success");
          this.$router.push({ name: "Admin" });
        })
        .catch(error => {
          Swal.fire("Error de autenticación", "Aceptar", "error");
        });
    }
  }
};
</script>