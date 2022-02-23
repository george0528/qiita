<template>
  <div>
    <CrownComponent :num="index + 1" />
    <span class="rank_index">{{ index + 1 }}</span>
  </div>
</template>

<script>
import CrownComponent from './CrownComponent.vue'
export default {
  components: { CrownComponent },
  props: ['index'],
}
</script>