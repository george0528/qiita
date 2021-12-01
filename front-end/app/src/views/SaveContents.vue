<template>
  <div class="SaveContent">
    <a class="content" v-for="item in contents" :href="item.post_url" :key="item.post_id">
      <div class="top">
        <div class="left">
          <p class="date">{{ content_date(item) }}</p>
          <p class="title">{{ item.title }}</p>
          <div class="tags">
            <span v-for="tag in item.tags" :key="tag.id">{{ tag.name }}</span>
          </div>
        </div>
        <div class="right" >
          <div @click.prevent="toggle_save(item)" :class="is_save_content(item.post_id)">
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
    <div class="load">
      <div v-if="load" class="component_load_circle"></div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
      return {
        url: '',
        contents: {},
        load: false ,
        save_contents: {},
      };
    } ,
  methods : {
    toggle_save(content) {
      let content_id = content.post_id;
      if(this.save_contents.length) {
        var id_include = this.is_include_id(content_id);
      }
      // 保存されていたら
      if(id_include) {
        // 配列から削除
        this.save_contents = this.save_contents.filter(content => content.post_id !== content_id);
      } else {
        // 配列に追加
        if(this.save_contents.length) {
          this.save_contents.push(content);
        } else {
          this.save_contents = [content];
        }
      }
      this.post_save_contents(this.save_contents);
    },
    get_save_contents() {
      let contents = JSON.parse(localStorage.getItem('save_contents'));
      if(contents) {
        this.save_contents = contents;
      }
    },
    post_save_contents(contents) {
      contents = JSON.stringify(contents);
      localStorage.setItem('save_contents', contents);
    },
    is_include_id(content_id) {
      return this.save_contents.find(content => content.post_id === content_id);
    }
  },
  mounted : function() {
    this.url = new URL('https://back-end.qiita-my-ranking.online/api/ranking');
    this.get_save_contents();
    this.contents = this.save_contents;
  },
  computed: {
    content_date: function() {
        return function(item) {
        let date = new Date(item.created_at);
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
    }
  }
}
</script>
<style>
  @import "../assets/css/style.css";
  @import "../assets/css/content.css";
</style>