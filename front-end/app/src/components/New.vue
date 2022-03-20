<template>
  <div id="New">
    <img src="@/assets/img/new.png" alt="">
  </div>
</template>

<style scoped>
  #New {
    width: 30px;
    margin-left: 5px;
    display: flex;
    align-items: center;
  }
  img {
    width: 100%;
  }
</style>

<script>
export default {
  props: ["is_new"],
}
</script>