<template>
  <v-app>
    <MenuAdmin></MenuAdmin>

    <v-main>
      <router-view></router-view>
    </v-main>

    <PiePagina></PiePagina>
  </v-app>
</template>

<script>
import Menu from "./components/navegacion/Menu.vue";
import MenuAdmin from "./components/navegacion/MenuAdmin";
import PiePagina from "./components/navegacion/Pie";
export default {
  components: {
    Menu,
    PiePagina,
    MenuAdmin
  }
};
</script>

<style></style>
