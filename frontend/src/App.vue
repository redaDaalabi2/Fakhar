<template>
  <div>
    <NavBar />
    <router-view />
    <Footer />
  </div>
</template>

<script>
  import NavBar from "./components/GlobalComponent/NavBar.vue";
  import Footer from "./components/GlobalComponent/Footer.vue";
  export default {
    name: "App",
    components: { 
      NavBar,
      Footer
    },
  }
</script>

<style lang="scss">
#app {
  font-family: $font-family;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-decoration: none;
  background-color: #f6f5f5;
}
* {
  list-style: none;
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}
</style>
