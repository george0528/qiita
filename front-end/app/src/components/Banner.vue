<template>
  <v-banner
    elevation="0"
    single-line
    sticky
    dark
    :color="bannerColor(this.$route.path)"
  >{{ bannerText(this.$route.path) }}</v-banner>
</template>

<script>
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
        return this.getPathColor(path);
      }
    },
  }
}
</script>