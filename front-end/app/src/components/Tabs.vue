<template>
  <v-tabs
    fixed-tabs
    v-if="isHome()"
    v-model="tab"
    @change="changeTab"
  >
    <v-tab
      v-for="item in tabs"
      :key="item.type"
      :value="item.value"
    >
      {{ item.type }}
    </v-tab>
  </v-tabs>
</template>

<script>
export default {
  data() {
    return {
      tabs: [
        {
          type: '週間',
          value: 'week',
          uri: '/',
        },
        {
          type: '月間',
          value: 'month',
          uri: '/save-contents'
        }
      ],
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
    }
  },
  mounted() {
    this.tab = this.$store.state.tab;
  }
}
</script>