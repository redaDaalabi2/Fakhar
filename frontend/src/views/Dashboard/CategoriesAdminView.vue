<template>
  <div>
    <Categories />
  </div>
</template>

<script>
import Categories from '@/components/AdminComponents/Categories.vue';
export default {
  name: "AnalyseAdmin",
  components: {
    Categories
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
