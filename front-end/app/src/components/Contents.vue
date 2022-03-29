<template>
<div>
  <div class="load" v-if="is_load">
    <div v-if="is_load" class="component_load_circle"></div>
  </div>
  <a class="content" @click.prevent="clickContent(item)" v-for="(item, index) in contents" :key="index">
    <div class="top">
      <div class="left">
        <div class="flex">
          <p class="date">{{ content_date(item.created_at) }}</p>
          <Rank :ranking="item.rank" v-if="rank"/>
          <New :is_new="item.is_new" v-if="rank && item.is_new"/>
          <!-- <p class="date" v-if="item.history_date">{{ history_date(item.history_date) }}</p> -->
        </div>
        <p class="title">{{ item.title }}</p>
        <div class="tags">
          <span v-for="tag in item.tags" :key="tag.id">{{ tag.name }}</span>
        </div>
      </div>
      <div class="right">
        <slot :item="item"></slot>
      </div>
    </div>
    <div class="bottom">
      <div class="user">
        <img :src="item.user_image_url" loading="lazy" alt="">
        <span>{{ item.user_name }}</span>
      </div>
      <div class="good">
        <img src="@/assets/img/good.png" loading="lazy" alt="">
        <span>{{ item.likes_count }}</span>
      </div>
    </div>
  </a>
</div>
</template>
<style scoped>
.v-application .title {
  font-size: 1rem!important;
}
</style>
<script>
import Rank from '@/components/Rank.vue'
import New from '@/components/New.vue'
export default {
  name: 'Contents',
  props: ['contents', 'save_contents', 'rank'],
  components: {
    Rank,
    New
  },
  methods: {
    clickContent(item) {
      // 履歴追加処理
      let now = new Date();
      item.history_date = now;
      this.addHistory(item);
      window.location.href = item.post_url;
    }
  },
  computed: {
    content_date: function() {
      return function(origin_date) {
        let date = new Date(origin_date);
        let date_string = `${date.getFullYear()}.${date.getMonth() + 1}.${date.getDate()}投稿`;
        return date_string;
      }
    },
    history_date: function() {
      return function(origin_date) {
        let date = new Date(origin_date);
        let date_string = `${date.getFullYear()}.${date.getMonth() + 1}.${date.getDate()} ${date.getHours()}:${date.getMinutes()}:${date.getSeconds()} 履歴追加`;
        return date_string;
      }
    },
    is_load(){
      return this.contents == null;
    }
  },
}
</script>