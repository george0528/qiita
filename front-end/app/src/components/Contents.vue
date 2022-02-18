<template>
<div>
  <a class="content" @click.prevent="clickContent(item)" v-for="(item, index) in contents" :key="index">
    <div class="top">
      <div class="left">
        <div class="flex">
          <p class="date">{{ content_date(item.created_at) }}</p>
          <Rank :index="index" v-if="rank"/>
          <!-- <p class="date" v-if="item.history_date">{{ history_date(item.history_date) }}</p> -->
        </div>
        <p class="title">{{ item.title }}</p>
        <div class="tags">
          <span v-for="tag in item.tags" :key="tag.id">{{ tag.name }}</span>
        </div>
      </div>
      <div class="right" >
        <div @click.stop.prevent="clickToggleSave(item)" :class="is_save_content(item.post_id)">
          <div class="bookmark">
          <img src="@/assets/img/bookmark.png" alt="">
          </div>
        </div>
      </div>
    </div>
    <div class="bottom">
      <div class="user">
        <img :src="item.user_image_url" alt="">
        <span>{{ item.user_name }}</span>
      </div>
      <div class="good">
        <img src="@/assets/img/good.png" alt="">
        <span>{{ item.likes_count }}</span>
      </div>
    </div>
  </a>
</div>

</template>

<script>
import Rank from '@/components/Rank.vue'
export default {
  name: 'Contents',
  props: ['contents', 'save_contents', 'is_include_id', 'rank'],
  components: {
    Rank
  },
  methods: {
    clickToggleSave(item) {
      this.$emit("toggle_btn_click", item);
    },
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
    history_date: function() {
      return function(origin_date) {
        let date = new Date(origin_date);
        let date_string = `${date.getFullYear()}.${date.getMonth() + 1}.${date.getDate()} ${date.getHours()}:${date.getMinutes()}:${date.getSeconds()} 履歴追加`;
        return date_string;
      }
    }
  },
}
</script>