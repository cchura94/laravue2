<template>
  <v-footer color="primary lighten-1" padless fixed>
    <v-row justify="center" no-gutters>
      <!--v-btn
        v-for="(link, index) in links"
        :key="index"
        color="white"
        text
        rounded
        class="my-2"
        :to="link.url"
      >{{ link.titulo }}</v-btn-->
      <v-col class="primary lighten-2 py-4 text-center white--text" cols="12">
        {{ new Date().getFullYear() }} —
        <strong>Mi Empresa</strong>
      </v-col>
    </v-row>
  </v-footer>
</template>

<script>
export default {
  data: () => ({
    links: [
      { titulo: "INICIO", url: "/" },
      { titulo: "NOSOTROS", url: "/nosotros" },
      { titulo: "CONTACTO", url: "/contacto" },
      { titulo: "INGRESAR", url: "/ingresar" }
    ]
  })
};
</script>

<style></style>
