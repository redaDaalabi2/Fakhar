<template>
  <div>
    <NavBar />
    
    <Footer />
  </div>
</template>

<script>
import NavBar from "@/components/GlobalComponent/NavBar.vue";
import Footer from "@/components/GlobalComponent/Footer.vue";
export default {
  name: "ProfileView",
  components: {
    NavBar,
    Footer
  },
  methods: {

  },
};
</script>

<style lang="scss" scoped>
@import "@/sass/_mixin.scss";

</style>
