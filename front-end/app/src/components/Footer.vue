<template>
<div id="footer">
  <div class="space"></div>
  <v-bottom-navigation
    fixed
    height="90"
    :color="bottomNavColor(this.$route.path)"
    :value="this.$route.path"
  >
    <v-btn v-my-touch:tap="tapBtn" value="/">
      <span>ホーム</span>
      <v-icon>{{ icons.home }}</v-icon>
    </v-btn>

    <v-btn v-my-touch:tap="tapBtn" value="/save-contents">
      <span>後で見る</span>

      <v-icon>{{ icons.heart }}</v-icon>
    </v-btn>

    <v-btn v-my-touch:tap="tapBtn" value="/history">
      <span>履歴</span>

      <v-icon>{{ icons.history }}</v-icon>
    </v-btn>
  </v-bottom-navigation>
</div>
</template>
<script>
import { mdiHome, mdiHeart, mdiHistory } from '@mdi/js';

export default {
  data() {
    return {
      icons: {
        home: mdiHome,
        heart: mdiHeart,
        history: mdiHistory
      }
    }
  },
  methods: {
    routerPush(path) {
      let current_uri = this.$route.path;
      if(current_uri != path) {
        this.$router.push(path);
      }
    },
    tapBtn(e) {
      let path = e.currentTarget.value;
      this.routerPush(path);
    }
  },
  computed: {
    bottomNavColor: function() {
      return function(path) {
        return this.getPathColor(path);
      }
    }
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
.v-item-group.v-bottom-navigation button{
  /* heightを指定しないと変になる */
  height: inherit;
  width: 130px;
}
.v-item-group.v-bottom-navigation a span, .v-icon{
  color: inherit !important;
}
.v-item-group.v-bottom-navigation {
  justify-content: space-around;
}
.v-item-group.v-bottom-navigation .v-btn {
  width: 130px;
}
.v-item-group.v-bottom-navigation .v-btn i {
  display: inline-block;
  margin-bottom: 5px;
}
/* こっちが上のspan(icon) */
.v-item-group.v-bottom-navigation .v-btn span span:nth-of-type(2) {
  padding-bottom: 10px;
  transform: scale(1.3);
}
/* メニューのタイトル */
.v-item-group.v-bottom-navigation .v-btn span span:nth-of-type(1) {
  padding-bottom: 25px;
  transform: scale(1.3);
}
/* btnの背景が灰色になるのを防ぐ */
.theme--light.v-btn.v-btn--has-bg {
  background-color: white;
}

@media screen and (max-width: 400px) {
  .v-item-group.v-bottom-navigation .v-btn {
    width: 30%;
  }
}
</style>