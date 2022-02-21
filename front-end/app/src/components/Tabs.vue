<template>
  <v-tabs
    fixed-tabs
    v-if="isHome()"
    v-model="tab"
  >
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
    changeTabWeek() {
      this.tab = 0;
      this.changeTab(0);
    },
    changeTabMonth() {
      this.tab = 1;
      this.changeTab(1);
    },
  },
  mounted() {
    this.tab = this.$store.state.tab;
  }
}
</script>