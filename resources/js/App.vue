<template>
  <v-app>
    <MenuAdmin v-if="$route.meta.requireAuth"></MenuAdmin>
    <Menu v-if="!$route.meta.requireAuth"></Menu>

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
  },
  data() {
    return {
      auth: false
    };
  },
  created() {
    //console.log(this.$route);
    //this.auth = this.$route.meta.requireAuth;
  }
};
</script>

<style></style>
