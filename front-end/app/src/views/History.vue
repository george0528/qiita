<template>
<div id="History">
  <div class="top_space"></div>
  <Contents 
    :contents="this.contents" 
    :rank="false"
    v-slot:default="slotProps"
  >
    <TrashBox :item="slotProps.item" @clickToggleBtn="toggle_save"/>
  </Contents>
</div>
</template>

<script>
import Contents from '@/components/Contents.vue'
import TrashBox from '@/components/TrashBox.vue'
export default {
  data() {
    return {
      contents: {},
      save_contents: {},
    };
  },
  components: {
    Contents,
    TrashBox
  },
  methods: {
    // ボタンクリック関数
    toggle_save(content) {
      let post_id = content.post_id;
      this.deleteHistory(post_id);
      if(!window.confirm('記事を削除しますか？')) return;
      // 履歴のレンダリング
      this.contents = this.getHistory().reverse();
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