<template>
    <div>
        <h1>Lista de CLientes</h1>

        <v-data-table
            :headers="headers"
            :items="desserts"
            sort-by="calories"
            class="elevation-1"
        >
            <template v-slot:top>
                <v-toolbar flat color="white">
                    <v-toolbar-title>CLIENTES</v-toolbar-title>
                    <v-divider class="mx-4" inset vertical></v-divider>
                    <v-spacer></v-spacer>
                    <v-dialog v-model="dialog" max-width="500px">
                        <template v-slot:activator="{ on, attrs }">
                            <v-btn
                                color="primary"
                                dark
                                class="mb-2"
                                v-bind="attrs"
                                v-on="on"
                                >Nuevo Cliente</v-btn
                            >
                        </template>
                        <v-card>
                            <v-card-title>
                                <span class="headline">{{ formTitle }}</span>
                            </v-card-title>

                            <v-card-text>
                                <v-container>
                                    <v-row>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field
                                                v-model="editedItem.nombres"
                                                label="Nombres"
                                            ></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field
                                                v-model="editedItem.apellidos"
                                                label="Apellidos"
                                            ></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field
                                                v-model="editedItem.empresa"
                                                label="Empresa"
                                            ></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field
                                                v-model="editedItem.correo"
                                                label="Correo"
                                            ></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field
                                                v-model="editedItem.telefono"
                                                label="Telefono"
                                            ></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field
                                                v-model="editedItem.ci_nit"
                                                label="CI/Nit"
                                            ></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-select
                                                :items="paises"
                                                item-text="nombre"
                                                item-value="id"
                                                v-model="pais_id"
                                                @change="consultarCiudades"
                                                label="Seleccionar El Pais"
                                            ></v-select>
                                        </v-col>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-select
                                                :items="ciudades"
                                                item-text="nombre"
                                                item-value="id"
                                                v-model="ciudad_id"
                                                @change="consultarMunicipio()"
                                                label="Seleccionar Ciudad:"
                                            ></v-select>
                                        </v-col>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-select
                                                :items="municipios"
                                                item-text="nombre"
                                                item-value="id"
                                                v-model="municipio_id"
                                                :disabled="estado"
                                                label="Seleccionar Municipio:"
                                            ></v-select>
                                        </v-col>
                                    </v-row>
                                    {{ editedItem }}
                                    <!--code>
                    <pre>{{ $data }}</pre>
                  </code-->
                                </v-container>
                            </v-card-text>

                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="blue darken-1" text @click="close"
                                    >Cancel</v-btn
                                >
                                <v-btn color="blue darken-1" text @click="save"
                                    >Save</v-btn
                                >
                            </v-card-actions>
                        </v-card>
                    </v-dialog>
                </v-toolbar>
            </template>
            <template v-slot:item.actions="{ item }">
                <v-icon small class="mr-2" @click="editItem(item)"
                    >mdi-pencil</v-icon
                >
                <v-icon small @click="deleteItem(item)">mdi-delete</v-icon>
            </template>
            <template v-slot:no-data>
                <v-btn color="primary" @click="iniciar">Reset</v-btn>
            </template>
        </v-data-table>
    </div>
</template>

<script>
import axios from "axios";
import { base_url } from "./../../../config/config";
import Swal from "sweetalert2";

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
            estado: true,

            dialog: false,
            headers: [
                {
                    text: "Nombres",
                    align: "start",
                    sortable: false,
                    value: "nombres"
                },
                { text: "Apellidos", value: "apellidos" },
                { text: "Empresa", value: "empresa" },
                { text: "Correo", value: "correo" },
                { text: "Telefono", value: "telefono" },
                { text: "Ci / NIT", value: "ci_nit" },
                { text: "Actions", value: "actions", sortable: false }
            ],
            desserts: [],
            editedIndex: -1,
            editedItem: {
                nombres: "",
                apellidos: "",
                empresa: "",
                correo: "",
                telefono: "",
                ci_nit: ""
            },
            defaultItem: {
                nombres: "",
                apellidos: "",
                empresa: "",
                correo: "",
                telefono: "",
                ci_nit: ""
            }
        };
    },
    computed: {
        formTitle() {
            return this.editedIndex === -1 ? "Nuevo Cliente" : "Editar Cliente";
        }
    },
    watch: {
        dialog(val) {
            val || this.close();
        }
    },
    created() {
        axios.get("http://localhost:8000/api/pais").then(datos => {
            this.paises = datos.data;
            console.log(this.paises);
        });

        this.iniciar();
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
        },
        iniciar() {
            axios.get(base_url + "/cliente").then(respuesta => {
                console.log(respuesta);
                this.desserts = respuesta.data.data;
            });
        },
        editItem(item) {
            this.editedIndex = this.desserts.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialog = true;
        },

        deleteItem(item) {
            const index = this.desserts.indexOf(item);
            confirm("Are you sure you want to delete this item?") &&
                this.desserts.splice(index, 1);
        },

        close() {
            this.dialog = false;
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem);
                this.editedIndex = -1;
            });
        },

        save() {
            if (this.editedIndex > -1) {
                Object.assign(this.desserts[this.editedIndex], this.editedItem);
            } else {
                axios
                    .post(base_url + "/cliente", this.editedItem)
                    .then(respuesta => {
                        if (respuesta.data.creado == false) {
                            console.log(respuesta.data);
                            Swal.fire(
                                "hubo un error a registrar al cliente",
                                "Aceptar",
                                "error"
                            );
                        } else {
                            this.close();
                            console.log(respuesta.data);
                            Swal.fire(
                                "Cliente registrado correctamente",
                                "Aceptar",
                                "success"
                            );
                        }
                    });
                this.desserts.push(this.editedItem);
            }
        }
    }
};
</script>

<style></style>
