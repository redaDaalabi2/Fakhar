<template>
  <div>
    <NavBar v-if="!affiche"/>
    <Sidebar v-else />
    <router-view />
    <Footer v-if="!affiche" />
  </div>
</template>

<script>
  import NavBar from "./components/GlobalComponent/NavBar.vue";
  import Footer from "./components/GlobalComponent/Footer.vue";
  import Sidebar from './components/GlobalComponent/Sidebar.vue';
  export default {
    name: "App",
    data() {
      return {
        
      };
    },
    components: {
      NavBar,
      Footer,
      Sidebar
    },
    mounted(){
      if (window.localStorage.getItem("token") != null) {
        if (window.localStorage.getItem("role") == "client") {
          this.$store.dispatch("set_role", "client");
          this.$store.dispatch("set_loggedin", true);
          this.$store.dispatch("set_affiche", false);
        } else if (window.localStorage.getItem("role") == "admin") {
          this.$store.dispatch("set_role", "admin");
          this.$store.dispatch("set_loggedin", true);
          this.$store.dispatch("set_affiche", true);
        } 
        }
        
      },
    computed:{
      affiche(){
        return this.$store.state.affiche;
      },
      role(){
        return this.$store.state.role;
      }
    }
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
.body{
  padding-left: 0 !important;
}
</style>
