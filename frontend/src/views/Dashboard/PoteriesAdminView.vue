<template>
  <div>
    <Sidebar />
    <Poteries />
  </div>
</template>

<script>
import Sidebar from '@/components/GlobalComponent/Sidebar.vue';
import Poteries from '../../components/AdminComponents/Poteries.vue';
export default {
  name: "AnalyseAdmin",
  components: {
    Sidebar,
    Poteries
  },
  methods: {
    
  }
}
</script>

<style>

</style>
