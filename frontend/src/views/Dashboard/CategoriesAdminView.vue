<template>
  <div>
    <Sidebar />
    <Categories />
  </div>
</template>

<script>
import Sidebar from '@/components/GlobalComponent/Sidebar.vue';
import Categories from '@/components/AdminComponents/Categories.vue';
export default {
  name: "AnalyseAdmin",
  components: {
    Sidebar,
    Categories
  },
  methods: {
    
  }
}
</script>

<style>

</style>
