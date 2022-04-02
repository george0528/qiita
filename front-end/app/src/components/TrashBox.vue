<template>
  <div @click.stop.prevent="(e) => clickToggleBtn(e, item)" class="circle">
    <div class="bookmark">
      <img src="@/assets/img/trash.png" loading="lazy" alt="">
    </div>
  </div>
</template>

<script>
export default {
  props: ['item'],
  methods: {
    clickToggleBtn(e, item) {
      this.$emit('clickToggleBtn', item);
    },
  }
}
</script>