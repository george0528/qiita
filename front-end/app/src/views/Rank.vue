<template>
    <div class="Rank">
        <!-- <h2>{{url}}</h2> -->
        <div class="load">
            <div v-if="load" class="component_load_circle"></div>
        </div>
        <!-- <div class="btns">
            <button @click="search(7)" class="component_btn primary">週間</button>
            <button @click="search(30)" class="component_btn primary">月間</button>
        </div> -->
        <a class="content" v-for="item in search_contents" :href="item.url" :key="item.id">
            <div class="left">
                <p class="date">{{ content_date(item) }}</p>
                <p class="title">{{ item.title }}</p>
                <div class="tags">
                    <span v-for="tag in item.tags" :key="tag.id">{{ tag.name }}</span>
                </div>
            </div>
            <div class="right"></div>
            <div class="bottom">
                <div class="user">
                    <img :src="item.user.profile_image_url" alt="">
                    <span>{{ item.user.name }}</span>
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
                search_contents: {},
                search_keyword: '',
                search_url: '',
                search_days: 7,
                select_date: '',
                url: '',
                per_page: 20,
                page: 1,
                query_param: '',
                contents: {},
                load: false ,
            };
        } ,
    methods : {
        base_url_set() {
            this.url = new URL('https://qiita.com/api/v2/items');
            let params = this.url.searchParams;
            params.set('per_page', this.per_page);
            params.set('page', this.page);
            this.query_param = `stocks:>${this.search_days}`;
            var day = this.get_date(this.search_days);
            this.query_param_set(day);
            if(this.query_param) {
                params.set('query', this.query_param)
            }
        },
        // search(days) {
        //     var day = this.get_date(this.search_days);
        //     let params = this.url.searchParams;
        // },
        query_param_set(param) {
            this.query_param = this.query_param+param;
        },
        async get_contents() {
            this.load = true;
            return await this.axios.get(this.url,{
                headers: {"Authorization":"Bearer 5fbe77e0acd1cb34b2d2e0877b68fab6729ca251"},
                data: {},
            })
            .then((response) => {
                let contents = response.data;
                console.log(contents);
                // 配列が空の時
                if(!contents.length) {
                    console.log('配列が空です、最後の配列です');
                    this.sort_like(this.contents);
                    this.contents.splice(20);
                    this.search_contents = this.contents;
                    this.load = false;
                    return false;
                }
                // 配列追加
                if(this.contents.length) {
                    this.contents = this.contents.concat(contents);
                } else {
                    this.contents = contents;
                }
                // 最後
                if(contents.length < this.per_page) {
                    this.sort_like(this.contents);
                    this.contents.splice(20);
                    this.search_contents = this.contents;
                    this.load = false;
                    return false;
                } else {
                    return true;
                }
            });
        },
        get_date(day) {
            var now = new Date();
            var select_date = new Date(now.getFullYear(), now.getMonth(), now.getDate() - day);
            var query_select_date = ` created:>=${select_date.getFullYear()}-${select_date.getMonth() + 1}-${select_date.getDate()}`;
            return query_select_date;
        },
        sort_like(contents) {
            contents.sort(function(a,b) {
                if(a.likes_count > b.likes_count) {
                    return -1;
                } else {
                    return 1;
                }
            });
        }
    },
    mounted : async function() {
        var loop_flag = true;
        this.base_url_set();
        while(loop_flag) {
            loop_flag = await this.get_contents();
            this.page++;
            let params = this.url.searchParams;
            params.set('page', this.page);
        }
    },
    computed: {
        contents_length: function (){
            return Object.keys(this.search_contents).length;
        },
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
    .content .left {
        width: 90%;
    }
    .content .left .date {
        color: gray;
        font-size: 0.7rem;
    }
    .content .left .title {
        font-weight: bold;
        padding: 0;
        margin: 2.5px 0;
        display: flex;
        align-items: center;
        /* max-height: 37px;
        overflow: hidden; */
    }
    .content .left .tags {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    .content .left .tags span {
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