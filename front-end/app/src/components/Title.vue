<template>
  <v-app-bar
    elevation="0"
    title
    height="56"
    color="white"
  >
    <v-app-bar-title class="title">
      Qiitaランキング
    </v-app-bar-title>
    <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
  </v-app-bar>
</template>
<script>
export default {
  data() {
    return {
      drawer: false
    }
  },
}
</script>
<style scoped>
.title {
  font-weight: bold;
}

.v-toolbar__content {
  justify-content: space-between;
}
</style>
