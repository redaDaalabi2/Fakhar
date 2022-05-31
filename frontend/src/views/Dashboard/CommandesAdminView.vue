<template>
  <div>
    <Sidebar />
    <Commandes />
  </div>
</template>

<script>
import Sidebar from '@/components/GlobalComponent/Sidebar.vue';
import Commandes from '../../components/AdminComponents/Commandes.vue';
export default {
  name: "AnalyseAdmin",
  components: {
    Sidebar,
    Commandes
  },
  methods: {
    
  }
}
</script>

<style>

</style>
