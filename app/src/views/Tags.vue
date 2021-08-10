<template>
    <div>
        <div class="search_box">
            <input  v-model="search_keyword" type="text">
            <div @click="select_tag" v-for="tag in tags" :key="tag.id">
                {{ tag.id }}
            </div>
            <button @click="search_tag" type="button">タグを検索</button>
        </div>
        <div v-if="my_select_tag">{{ my_select_tag }}</div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            tags: '',
            my_select_tag: '',
            search_keyword: '',
            url: '',
        }
    },
    methods: {
        select_tag(tag) {
            this.my_select_tag = tag;
        },
        search_tag() {
            this.url = new URL('https://qiita.com/api/v2/tags');
            let params = this.url.searchParams;
            params;
            this.axios.get(this.url,{
                headers: {"Authorization":"Bearer 5fbe77e0acd1cb34b2d2e0877b68fab6729ca251"},
                data: {},
            })
            .then((response) => {
                console.log(response.data);
                this.tags = response.data;
            });
        }
    },
    created: function() {

    },
}
</script>