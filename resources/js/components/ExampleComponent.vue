<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <router-link to="/">INICIO</router-link>|
        <router-link to="/contacto">CONTACTO</router-link>|
        <router-link to="/nosotros">NOSOTROS</router-link>
        <router-link to="/publicacion">Publicacion</router-link>
      </div>
      <div class="col-md-8">
        <div class="card">
          <div class="card-header"></div>

          <div class="card-body">
            <router-view></router-view>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  mounted() {
    console.log("Component mounted.");
  }
};
</script>
