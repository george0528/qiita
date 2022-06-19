<template>
  <div class="Home">
    <div class="top_space"></div>
    <v-tabs-items :value="this.$store.state.tab" @change="changeTabItem">
      <v-tab-item eager>
        <Contents
          :contents="this.three_contents"
          :rank="true"
          v-slot:default="slotProps"
        >
          <Bookmark :item="slotProps.item" @clickToggleBtn="toggle_save" :save_contents="save_contents"/>
        </Contents>
      </v-tab-item>
      <v-tab-item eager>
        <Contents
          :contents="this.week_contents"
          :rank="true"
          v-slot:default="slotProps"
        >
          <Bookmark :item="slotProps.item" @clickToggleBtn="toggle_save" :save_contents="save_contents"/>
        </Contents>
      </v-tab-item>
      <v-tab-item eager>
        <Contents
          :contents="this.month_contents"
          :rank="true"
          v-slot:default="slotProps"
        >
          <Bookmark :item="slotProps.item" @clickToggleBtn="toggle_save" :save_contents="save_contents"/>
        </Contents>
      </v-tab-item>
    </v-tabs-items>
  </div>
</template>
<script>
import Bookmark from '@/components/Bookmark.vue'
import Contents from '@/components/Contents.vue'
import consts from '@/util/consts.js'
export default {
  data() {
    return {
      url: `${process.env.VUE_APP_API_URL}/ranking`,
      three_contents: {},
      week_contents: {},
      month_contents: {},
      save_contents: {},
    };
  },
  components: {
    Contents,
    Bookmark
  },
  methods : {
    changeTabItem(new_tab) {
      this.$store.commit('changeTab', new_tab);
    },
    // ランキング取得
    get_contents(type) {
      // キャッシュを取得
      let cache_contents = JSON.parse(localStorage.getItem(this.getSaveCotentsName(type)));

      // キャッシュを表示
      this.setContentsByType(type, cache_contents);

      // キャッシュの更新をしなくていいなら
      if(!this.shouldCacheUpdate()) {
        return;
      }

      // キャッシュの更新すべきか確認
      this.axios.get(this.url, {
        params: {
          type: type
        }
      })
      .then((response) => {
        let new_contents = response.data;
        // contentsを更新
        this.setContentsByType(type, new_contents);
        // 更新した日付を保存
        localStorage.setItem(this.getSaveCotentsName(type)+'_cache_update_date', new Date());
        // ローカルストレージに新しいコンテンツをキャッシュとして保存
        localStorage.setItem(this.getSaveCotentsName(type), JSON.stringify(new_contents));
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
        case consts.WEEK:
          return 'contents';
        case consts.MONTH:
          return 'month_contents';
        case consts.THREE:
          return 'three_contents';
        default:
          return 'contents';
      }
    },
    // type別のコンテンツにセットする
    setContentsByType(type, contents) {
      switch (type) {
        case consts.WEEK:
          this.week_contents = contents;
          break;
        case consts.MONTH:
          this.month_contents = contents;
          break;
        case consts.THREE:
          this.three_contents = contents;
          break;
        default:
          this.week_contents = contents;
          break;
      }
    },
    // type別のコンテンツを取得する
    getContentsByType(type) {
      switch (type) {
        case consts.WEEK:
          return this.week_contents;
        case consts.MONTH:
          return this.month_contents;
        case consts.THREE:
          return this.three_contents;
        default:
          return this.week_contents;
      }
    },
    // cacheの更新すべきか
    shouldCacheUpdate(type) {
      let lastUpdateDate = localStorage.getItem(this.getSaveCotentsName(type)+'_cache_update_date');
      // localStorageになかったら
      if(lastUpdateDate == null) {
        return true;
      }
      lastUpdateDate = new Date(lastUpdateDate);
      let now = new Date();
      // 日付比較
      if(
        now.getFullYear() != lastUpdateDate.getFullYear() ||
        now.getMonth() != lastUpdateDate.getMonth() ||
        now.getDate() != lastUpdateDate.getDate()
      ) {
        return true;
      }

      return false;
    },
  },
  beforeMount() {
    this.get_contents(consts.WEEK);
  },
  mounted : function() {
    this.get_save_contents();
    this.get_contents(consts.MONTH);
    this.get_contents(consts.THREE);
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