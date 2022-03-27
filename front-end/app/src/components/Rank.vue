<template>
  <div id="Rank">
    <crown :num="ranking" />
    <span class="rank_index">{{ ranking }}</span>
  </div>
</template>
<style scoped>
  div {
    display: flex;
    align-items: center;
  }
</style>

<script>
import Crown from './Crown.vue'
export default {
  components: { Crown },
  props: ['ranking'],
}
</script>