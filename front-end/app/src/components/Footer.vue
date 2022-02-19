<template>
<div id="footer">
  <div class="space"></div>
  <v-bottom-navigation
    v-model="value"
    fixed
    height="90"
    background-color="white"
    color="success"
  >
  <router-link to="/">
    <v-btn value="/" :ripple="false">
      <span>ホーム</span>

      <v-icon>mdi-home</v-icon>
    </v-btn>
  </router-link>

  <router-link to="/save-contents">
    <v-btn value="/save-contents" :ripple="false">
      <span>後で見る</span>

      <v-icon>mdi-heart</v-icon>
    </v-btn>
  </router-link>

  <router-link to="/history">
    <v-btn value="/history" :ripple="false">
      <span>履歴</span>

      <v-icon>mdi-history</v-icon>
    </v-btn>
  </router-link>
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
* {
  box-sizing: border-box;
}
#footer .space{
  height: 90px;
}
.v-item-group.v-bottom-navigation a{
 height: inherit;
}
.router-link-exact-active.router-link-active {
  color: #4caf50 !important;
}
.v-item-group.v-bottom-navigation {
  justify-content: space-around;
}
.v-item-group.v-bottom-navigation .v-btn {
  width: 130px;
}
.v-item-group.v-bottom-navigation .v-btn :nth-of-type(1){
  transform: scale(1.1);
}
.v-item-group.v-bottom-navigation .v-btn i {
  display: inline-block;
  margin-bottom: 5px;
}
.v-item-group.v-bottom-navigation .v-btn span span {
  margin-bottom: 20px;
}
</style>