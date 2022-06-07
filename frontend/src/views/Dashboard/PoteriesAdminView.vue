<template>
  <div>
    <Poteries />
  </div>
</template>

<script>
import Poteries from '../../components/AdminComponents/Poteries.vue';
export default {
  name: "AnalyseAdmin",
  components: {
    Poteries
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
