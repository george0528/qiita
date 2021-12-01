<template>
  <div class="NewRank">
    <div class="load">
      <div v-if="load" class="component_load_circle"></div>
    </div>
    <!-- <div class="btns">
      <button @click="search(7)" class="component_btn primary">週間</button>
      <button @click="search(30)" class="component_btn primary">月間</button>
    </div> -->
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
          <div class="circle">
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
export default {
  data() {
      return {
        url: '',
        contents: {},
        load: false ,
      };
    } ,
  methods : {
    get_contents() {
      this.load = true;
      return this.axios.get(this.url)
      .then((response) => {
        let contents = response.data;
        // 配列追加
          this.contents = contents;
          this.load = false;
      });
    },
  },
  mounted : function() {
    this.url = new URL('https://back-end.qiita-my-ranking.online/api/ranking');
    this.get_contents();
  },
  computed: {
    content_date: function() {
        return function(item) {
        let date = new Date(item.created_at);
        let date_string = `${date.getFullYear()}.${date.getMonth() + 1}.${date.getDate()}投稿`;
        return date_string;
      }
    }
  }
}
</script>
<style>
  @import "../assets/css/style.css";
  a {
    color: black;
    text-decoration: none;
    text-align: left;
    font-size: 0.8rem;
  }
  p {
    margin: 0;
  }
  span {
    font-size: 0.7rem;
  }
  .load {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 10px 0;
  }
  a.contenet{
    width: 100vw;
  }
  .content .top {
    width: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  .content .top .rigth {
    width: 10%;
  }
  .content .top .right .circle {
    background-color: silver;
    border-radius: 50%;
    padding: 5px;
  }
  .content .top .right .circle.save {
    background-color: rgb(0, 180, 0);
  }
  .content .top .right .circle .bookmark {
    width: 13px;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  .content .top .right .circle .bookmark img {
    display: block;
    width: 100%;
  }
  .content .top .left {
    width: 90%;
  }
  .content .top .left .date {
    color: gray;
    font-size: 0.7rem;
  }
  .content .top .left .title {
    font-weight: bold;
    padding: 0;
    margin: 2.5px 0;
    display: flex;
    align-items: center;
    /* max-height: 37px;
    overflow: hidden; */
  }
  .content .top .left .tags {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
  }
  .content .top .left .tags span {
    margin-right: 4px;
    color: gray;
  }
  .content .bottom {
    display: flex;
    justify-content: space-between;
    align-items: center;
    height: 40px;
    margin: 2.5px 0;
  }
  .content .bottom .user {
    display: flex;
    align-items: center;
  }
  .content .bottom .user img {
    display: block;
    width: 25px;
    height: auto;
    margin-right: 10px;
    border-radius: 50%;
  }
  .content .bottom .good {
    display: flex;
    align-items: center;
  }
  .content .bottom .good span {
    display: block;
    margin:0 5px;
  }
  .content .bottom .good img{
    display: block;
    margin:0 5px;
    width: 15px;
  }
</style>