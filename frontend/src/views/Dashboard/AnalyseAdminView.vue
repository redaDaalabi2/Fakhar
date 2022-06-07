<template>
  <div>
    <Analyse />
  </div>
</template>

<script>
import Analyse from "@/components/AdminComponents/Analyse.vue";
export default {
  name: "AnalyseAdmin",
  components: {
    Analyse
  },
  methods: {

  },
  beforeMount(){
    let checklocal = localStorage.getItem('token');
    if(!checklocal){
      this.$router.push('/LoginAdminView');
    }
  }
};
</script>

<style>

</style>
