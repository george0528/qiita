<template>
  <v-app id="app">
    <div class="fixed">
      <Title />
      <Tabs />
      <Banner />
    </div>
    <div class="top_space"></div>
    <router-view/>
    <Footer />
  </v-app>
</template>

<script>
import Footer from '@/components/Footer.vue'
import Banner from '@/components/Banner.vue'
import Title from '@/components/Title.vue'
import Tabs from '@/components/Tabs'
export default {
  components: {
    Footer,
    Banner,
    Title,
    Tabs
  },
}
</script>
<style scoped>
.fixed {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  z-index: 1000;
  box-shadow: none;
  height: 95px;
}
.top_space {
  height: 95px;
}
</style>
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
