<template>
  <div>
    <v-navigation-drawer v-model="drawer" app clipped left>
      <v-list dense>
        <v-list-item link>
          <v-list-item-action>
            <v-icon>mdi-home</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>INICIO</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item link to="/admin/cliente">
          <v-list-item-action>
            <v-icon>mdi-account</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>CLIENTE</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item link to="/admin/producto">
          <v-list-item-action>
            <v-icon>mdi-email</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>PRODUCTO</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item link to="/admin/pedido">
          <v-list-item-action>
            <v-icon>mdi-email</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>PEDIDO</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>

    <v-app-bar app clipped-left color="indigo" dark>
      <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
      <v-toolbar-title>PANEL</v-toolbar-title>
    </v-app-bar>
  </div>
</template>

<script>
export default {
  data: () => ({
    drawer: null
  })
};
</script>

<style>
</style>