<template>
  <div class="Home">
    <div class="top_space"></div>
    <div class="load" v-if="load">
      <div v-if="load" class="component_load_circle"></div>
    </div>
    <v-tabs-items :value="this.$store.state.tab" @change="changeTabItem">
      <v-tab-item eager>
        <Contents
          :contents="this.three_contents" 
          :save_contents="this.save_contents"
          :is_include_id="this.is_include_id"
          @toggle_btn_click="toggle_save"
          :rank="true"
        />
      </v-tab-item>
      <v-tab-item eager>
        <Contents
          :contents="this.contents" 
          :save_contents="this.save_contents"
          :is_include_id="this.is_include_id"
          @toggle_btn_click="toggle_save"
          :rank="true"
        />
      </v-tab-item>
      <v-tab-item eager>
        <Contents
          :contents="this.month_contents" 
          :save_contents="this.save_contents"
          :is_include_id="this.is_include_id"
          @toggle_btn_click="toggle_save"
          :rank="true"
        />
      </v-tab-item>
    </v-tabs-items>
  </div>
</template>
<script>
import Contents from '@/components/Contents.vue'
export default {
  data() {
      return {
        url: `${process.env.VUE_APP_API_URL}/ranking`,
        three_contents: {},
        contents: {},
        month_contents: {},
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
    changeTabItem(new_tab) {
      this.$store.commit('changeTab', new_tab);
    },
    // ランキング取得
    get_contents(type) {
      this.cache_contents = JSON.parse(localStorage.getItem('contents'));
      // ローカルストレージにコンテンツがあればとりあえず表示
      this.contents = this.cache_contents;

      if(this.cache_contents == null) {
        this.load = true;
      }

      return this.axios.get(this.url, {
        params: {
          type: type
        }
      })
      .then((response) => {
        let contents = response.data;
        // 週間ランキング
        if(type == 1) {
          // 現在のコンテンツと比較して
          if(!this.array_compare(this.cache_contents, contents)) {
            // 配列追加
            this.contents = contents;
          }
        // ローカルストレージにコンテンツをキャッシュとして保存
        localStorage.setItem('contents', JSON.stringify(contents));
        }
        // 月間ランキング取得
        if(type == 2) {
          this.month_contents = contents;
        }
        // 3日のランキング取得
        if(type == 3) {
          this.three_contents = contents;
        }
        this.load = false;
      })
      .catch(() => {
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
  beforeMount() {
    this.get_contents(1);
  },
  mounted : function() {
    this.get_save_contents();
    this.get_contents(2);
    this.get_contents(3);
    window.scrollTo(0, 0); 
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
    model_tab: {
      get () {
        return this.tab
      },
      set (new_tab) {
        this.$store.commit('changeTab', new_tab);
      }
    }
  }
}
</script>
<style>
  @import "../assets/css/content.css";
  @import "../assets/css/style.css";
</style>
<style scoped>
  .top_space {
    height: 48px;
  }
</style>