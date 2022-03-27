<template>
  <v-tabs
    fixed-tabs
    v-if="isHome()"
    @change="changeTab"
    :value="this.$store.state.tab"
  >
    <v-tab v-my-touch:tap="changeTabThree">
      3日
    </v-tab>
    <v-tab v-my-touch:tap="changeTabWeek">
      週間
    </v-tab>
    <v-tab v-my-touch:tap="changeTabMonth">
      月間
    </v-tab>
  </v-tabs>
</template>

<script>
export default {
  data() {
    return {
      tab: null
    }
  },
  computed: {
    isHome: function() {
      return function() {
        if(this.$route.path == '/') {
          return true;
        }
        return false;
      }
    },
  },
  methods: {
    changeTab(new_tab) {
      this.$store.commit('changeTab', new_tab);
    },
    changeTabThree() {
      this.tab = 0;
      this.changeTab(0);
    },
    changeTabWeek() {
      this.tab = 1;
      this.changeTab(1);
    },
    changeTabMonth() {
      this.tab = 2;
      this.changeTab(2);
    },
  },
  mounted() {
    this.tab = this.$store.state.tab;
  }
}
</script>