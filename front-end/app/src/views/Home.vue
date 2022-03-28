<template>
  <div class="Home">
    <div class="top_space"></div>
    <div class="load" v-if="load">
      <div v-if="load" class="component_load_circle"></div>
    </div>
    <v-tabs-items :value="this.$store.state.tab" @change="changeTabItem">
      <v-tab-item eager>
        <Contents
          :contents="this.arr_contents[3]" 
          :save_contents="this.save_contents"
          :is_include_id="this.is_include_id"
          @toggle_btn_click="toggle_save"
          :rank="true"
        />
      </v-tab-item>
      <v-tab-item eager>
        <Contents
          :contents="this.arr_contents[1]" 
          :save_contents="this.save_contents"
          :is_include_id="this.is_include_id"
          @toggle_btn_click="toggle_save"
          :rank="true"
        />
      </v-tab-item>
      <v-tab-item eager>
        <Contents
          :contents="this.arr_contents[2]" 
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
        arr_contents: [],
        load: false,
        save_contents: {},
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
      // キャッシュを取得
      let cache_contents = JSON.parse(localStorage.getItem(this.getSaveCotentsName(type)));

        // キャッシュを入れる
        this.arr_contents[type] = cache_contents;

      if(cache_contents == null) {
        this.load = true;
      }

      this.axios.get(this.url, {
        params: {
          type: type
        }
      })
      .then((response) => {
        let new_contents = response.data;
          // 現在のコンテンツと比較して違う場合
          if(!this.is_array_same(this.arr_contents[type], new_contents)) {
            // contentsを更新
            this.arr_contents[type] = new_contents;
            // ローカルストレージに新しいコンテンツをキャッシュとして保存
            localStorage.setItem(this.getSaveCotentsName(type), JSON.stringify(new_contents));
          }

        this.load = false;
      })
      .catch(() => {
        this.load = false;
      });
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
    is_array_same(ary1, ary2){
      if(JSON.stringify(ary1) === JSON.stringify(ary2)) {
        return true;
      }
      return false;
    },
    // コンテンツのキャッシュの名前を取得
    getSaveCotentsName(type) {
      switch (type) {
        case 1:
          return 'contents';
        case 2:
          return 'month_contents';
        case 3:
          return 'three_contents';
        default:
          return 'contents';
      }
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