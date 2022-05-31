<template>
  <div>
    <Sidebar />
    <Analyse />
  </div>
</template>

<script>
import Sidebar from "@/components/GlobalComponent/Sidebar.vue";
import Analyse from "@/components/AdminComponents/Analyse.vue";
export default {
  name: "AnalyseAdmin",
  components: {
    Sidebar,
    Analyse
  },
  methods: {},
};
</script>

<style></style>
