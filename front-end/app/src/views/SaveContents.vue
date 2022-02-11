<template>
  <div class="SaveContent">
    <div class="top_space"></div>
    <Contents 
      :contents="this.contents"
      :save_contents="this.save_contents"
      :is_include_id="this.is_include_id"
      @toggle_btn_click="toggle_save"
      :rank="false"
    />
  </div>
</template>
<script>
import Contents from '@/components/Contents'
export default {
  data() {
    return {
      url: '',
      contents: {},
      save_contents: {},
    };
  },
  components: {
    Contents
  },
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
    this.contents.reverse();
  }
}
</script>
<style>
  @import "../assets/css/style.css";
  @import "../assets/css/content.css";
</style>