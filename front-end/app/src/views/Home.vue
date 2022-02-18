<template>
  <div class="Home">
    <div class="load" v-if="load">
      <div v-if="load" class="component_load_circle"></div>
    </div>
    <div class="top_space"></div>
    <div class="btns">
      <button v-if="this.type != 1" @click="changeType(1)" class="component_btn primary">週間</button>
      <button v-if="this.type != 2" @click="changeType(2)" class="component_btn primary">月間</button>
    </div>
    <Contents
      :contents="this.contents" 
      :save_contents="this.save_contents"
      :is_include_id="this.is_include_id"
      @toggle_btn_click="toggle_save"
      :rank="true"
    />
  </div>
</template>
<script>
import Contents from '@/components/Contents.vue'
export default {
  data() {
      return {
        url: '',
        contents: {},
        load: false,
        save_contents: {},
        cache_contents: {},
        type: 1,
      };
    },
  components: {
    Contents,
  },
  methods : {
    // ランキング取得
    get_contents() {
      this.cache_contents = JSON.parse(localStorage.getItem('contents'));
      // ローカルストレージにコンテンツがあればとりあえず表示
      this.contents = this.cache_contents;

      if(this.cache_contents == null) {
        this.load = true;
      }

      return this.axios.get(this.url, {
        params: {
          type: this.type
        }
      })
      .then((response) => {
        let contents = response.data;
        // 現在のコンテンツと比較して
        if(!this.array_compare(this.cache_contents, contents)) {
          // 配列追加
          this.contents = contents;
        }
        // ローカルストレージにコンテンツをキャッシュとして保存
        localStorage.setItem('contents', JSON.stringify(contents));
        this.load = false;
      })
      .catch(e => {
        console.log(e);
        this.load = false;
      });
    },
    // 期間の変更ボタン
    changeType(type) {
      // タイプが違う場合は
      if(type != this.type) {
        this.type = type;
        this.get_contents();
      }
    },
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
    // 配列比較関数
    array_compare(ary1, ary2){
      if(JSON.stringify(ary1) === JSON.stringify(ary2)) {
        return true;
      }
      return false;
    } 
  },
  mounted : function() {
    this.url = 'https://back-end.qiita-my-ranking.online/api/ranking';
    this.get_contents();
    this.get_save_contents();
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
  }
}
</script>
<style>
  @import "../assets/css/content.css";
  @import "../assets/css/style.css";
</style>