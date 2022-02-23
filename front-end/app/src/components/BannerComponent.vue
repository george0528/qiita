<template>
  <v-banner
    elevation="0"
    single-line
    dark
    tile
    height="39"
    :color="bannerColor(this.$route.path)"
  >{{ bannerText(this.$route.path) }}</v-banner>
</template>

<script>
import utilsFunction from '../util/utils.vue';
const utils = utilsFunction();
export default {
  computed: {
    bannerText :function() {
      return function(path) {
        let text = '';
        switch (path) {
          case '/':
            text = 'ホーム';
            break;
          case '/save-contents':
            text = '後で見る';
            break;
          case '/history':
            text = '履歴';
            break;
          default:
            text = 'default';
            break;
        }
        return text;
      }
    },
    bannerColor :function() {
      return function(path) {
        return utils.getPathColor(path);
      }
    },
  }
}
</script>