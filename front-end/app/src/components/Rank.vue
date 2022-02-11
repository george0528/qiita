<template>
  <div>
    <crown :num="index + 1" />
    <span class="rank_index">{{ index + 1 }}</span>
  </div>
</template>

<script>
import Crown from './Crown.vue'
export default {
  components: { Crown },
  props: ['index'],
}
</script>