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
  <v-btn @click="routerPush('/')">v-btn</v-btn>
    <button value="/" :ripple="false"  @click="routerPush('/')">
      <span>ホーム</span>
      <v-icon>mdi-home</v-icon>
    </button>
    <v-btn @click="routerPush('/')" value="/" :ripple="false">
      <span>ホーム</span>
      <v-icon>mdi-home</v-icon>
    </v-btn>

    <v-btn @click="routerPush('/save-contents')" value="/save-contents" :ripple="false">
      <span>後で見る</span>

      <v-icon>mdi-heart</v-icon>
    </v-btn>

    <v-btn value="/history" @click="routerPush('/history')" :ripple="false">
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
  methods: {
    routerPush(uri) {
      this.$router.push(uri);
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