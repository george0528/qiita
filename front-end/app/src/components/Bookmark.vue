<template>
  <div @click.stop.prevent="(e) => clickToggleBtn(e, item)" :class="is_save_content(item.post_id)">
    <div class="bookmark">
      <img src="@/assets/img/trash.png" loading="lazy" alt="">
    </div>
  </div>
</template>

<script>
export default {
  props: ['item', 'save_contents'],
  methods: {
    clickToggleBtn(e, item) {
      this.$emit('clickToggleBtn', item);
    },
    is_include_id(content_id) {
      return this.save_contents.find(content => content.post_id === content_id);
    }
  },
  computed: {
    is_save_content: function() {
      return function(id) {
        if(this.save_contents.length) {
          var is_include = this.is_include_id(id);
        } else {
          is_include = false;
        }
        if(is_include) {
          return 'circle save';
        } else {
          return 'circle';
        }
      }
    },
  }
}
</script>