<template>
  <v-app>
    <Menu></Menu>

    <v-main>
      <router-view></router-view>
    </v-main>

    <PiePagina></PiePagina>
  </v-app>
</template>

<script>
import Menu from "./components/navegacion/Menu.vue";
import PiePagina from "./components/navegacion/Pie";
export default {
  components: {
    Menu,
    PiePagina
  }
};
</script>

<style></style>
