<template>
<div id="History">
  <div class="top_space"></div>
  <ContentsComponent 
      :contents="this.contents" 
      :save_contents="this.save_contents"
      :is_include_id="this.is_include_id"
      @toggle_btn_click="toggle_save"
      :rank="false"
  />
</div>
</template>

<script>
import ContentsComponent from '@/components/ContentsComponent.vue'
export default {
  data() {
    return {
      contents: {},
      save_contents: {},
    };
  },
  components: {
    ContentsComponent
  },
  methods: {
    // 保存ボタンクリック関数
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
    }
  },
  mounted() {
    this.contents = this.getHistory().reverse();
    this.get_save_contents();
  }
}
</script>