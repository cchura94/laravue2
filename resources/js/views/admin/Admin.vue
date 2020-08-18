<template>
  <v-container>
    <h1>ADMINISTRADOR</h1>
    <nav>
      <router-Link to="/admin/cliente">Cliente</router-Link>|
      <router-Link to="/admin/producto">Producto</router-Link>
    </nav>
    <v-main>
      <router-view></router-view>
    </v-main>
  </v-container>
</template>

<script>
export default {};
</script>

<style>
</style>