<template>
<div id="footer">
  <div class="space"></div>
  <v-bottom-navigation
      v-model="value"
      fixed
      background-color="white"
      color="success"
  >
    <v-btn value="/" to="/">
      <span>ホーム</span>

      <v-icon>mdi-home</v-icon>
    </v-btn>

    <v-btn value="/save-contents" to="/save-contents">
      <span>後で見る</span>

      <v-icon>mdi-heart</v-icon>
    </v-btn>

    <v-btn value="/history" to="/history">
      <span>履歴</span>

      <v-icon>mdi-history</v-icon>
    </v-btn>
  </v-bottom-navigation>
</div>
</template>
<script>
export default {
  data() {
    return {
      value: '/'
    }
  },
  mounted() {
    this.value = this.$route.path;
  }
}
</script>
<style scoped>
#footer .space{
  height: 56px;
}
</style>