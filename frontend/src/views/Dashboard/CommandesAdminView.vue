<template>
  <div>
    <Commandes />
  </div>
</template>

<script>
import Commandes from '../../components/AdminComponents/Commandes.vue';
export default {
  name: "AnalyseAdmin",
  components: {
    Commandes
  },
  methods: {
    
  },
  beforeMount(){
    let checklocal = localStorage.getItem('token');
    if(!checklocal){
      this.$router.push('/LoginAdminView');
    }
  }
}
</script>

<style>

</style>
