<template>
  <v-app id="app">
    <div id="nav">
      <h1>Qiitaランキング</h1>
    </div>

    <router-view/>
    <button @click="routerPush('/')">click</button>
    <router-link to="/">
      <span>ホーム</span>

      <v-icon>mdi-home</v-icon>
    </router-link>
    <Footer />
  </v-app>
</template>

<script>
import Footer from '@/components/Footer.vue'
export default {
  components: {
    Footer
  },
  methods: {
    routerPush(uri) {
      this.$router.push(uri);
    }
  }
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

.v-application a div{
  color: #2c3e50;
}

.v-application div p {
  margin: 0;
}

#nav {
  padding: 30px;
  box-shadow: 1px 1px 3px silver;
}

#nav a {
  font-weight: bold;
  color: #2c3e50;
}

#nav a.router-link-exact-active {
  color: #42b983;
}
</style>
