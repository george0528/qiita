<template>
<div id="footer">
  <div class="space"></div>
  <v-bottom-navigation
    fixed
    height="90"
    background-color="white"
    color="success"
    :value="this.$route.path"
  >
    <v-btn @touchend="routerPush('/')" value="/">
      <span>ホーム</span>
      <v-icon>mdi-home</v-icon>
    </v-btn>

    <v-btn @touchend="routerPush('/save-contents')" value="/save-contents">
      <span>後で見る</span>

      <v-icon>mdi-heart</v-icon>
    </v-btn>

    <v-btn @touchend="routerPush('/history')" value="/history">
      <span>履歴</span>

      <v-icon>mdi-history</v-icon>
    </v-btn>
  </v-bottom-navigation>
</div>
</template>
<script>
export default {
  methods: {
    routerPush(uri) {
      let current_uri = this.$route.path;
      if(current_uri != uri) {
        console.log('遷移');
        this.$router.push(uri);
      }
    }
  },
}
</script>
<style scoped>
* {
  box-sizing: border-box;
}
#footer .space{
  height: 90px;
}
.v-item-group.v-bottom-navigation a, button{
  display: flex;
  flex-direction: column-reverse;
  justify-content: center;
  align-items: center;
  height: inherit;
  width: 130px;
  color: rgba(0,0,0,.6);
}
.v-item-group.v-bottom-navigation a span, .v-icon{
  color: inherit !important;
}
.router-link-exact-active.router-link-active {
  color: #4caf50 !important;
  background-color: rgba(78,176,81, 0.3);
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