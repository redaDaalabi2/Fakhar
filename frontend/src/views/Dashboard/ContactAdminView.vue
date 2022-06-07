<template>
  <div>
    <Contacte />
  </div>
</template>

<script>
import Contacte from '../../components/AdminComponents/Contacte.vue';
export default {
  name: "ContacteAdmin",
  components: {
    Contacte
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
