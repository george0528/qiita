<template>
<div id="History">
  <div class="top_space"></div>
  <Contents 
    :contents="this.contents" 
    :rank="false"
    v-slot:default="slotProps"
  >
    <Bookmark :item="slotProps.item" @clickToggleBtn="toggle_save" :save_contents="save_contents"/>
  </Contents>
</div>
</template>

<script>
import Contents from '@/components/Contents.vue'
import Bookmark from '@/components/Bookmark.vue'
export default {
  data() {
    return {
      contents: {},
      save_contents: {},
    };
  },
  components: {
    Contents,
    Bookmark
  },
  methods: {
    // ボタンクリック関数
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
    // セーブコンテンツ取得
    get_save_contents() {
      let contents = JSON.parse(localStorage.getItem('save_contents'));
      if(contents) {
        this.save_contents = contents;
      }
    },
    // セーブコンテンツに追加
    post_save_contents(contents) {
      contents = JSON.stringify(contents);
      localStorage.setItem('save_contents', contents);
    },
    // セーブコンテンツに含まれているかチェックする関数
    is_include_id(content_id) {
      return this.save_contents.find(content => content.post_id === content_id);
    },
  },
  mounted() {
    this.contents = this.getHistory().reverse();
    this.get_save_contents();
    window.scrollTo(0, 0); 
  }
}
</script>