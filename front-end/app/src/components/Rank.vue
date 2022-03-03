<template>
  <div id="Rank">
    <crown :num="index + 1" />
    <span class="rank_index">{{ index + 1 }}</span>
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
  props: ['index'],
}
</script>