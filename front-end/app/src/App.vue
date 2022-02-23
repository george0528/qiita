<template>
  <v-app id="app">
    <div class="fixed">
      <TitleComponent />
      <BannerComponent />
      <TabsComponent />
    </div>
    <div class="top_space"></div>
    <router-view/>
    <FooterComponent />
  </v-app>
</template>

<script>
import FooterComponent from '@/components/FooterComponent.vue'
import BannerComponent from '@/components/BannerComponent.vue'
import TitleComponent from '@/components/TitleComponent.vue'
import TabsComponent from '@/components/TabsComponent'
export default {
  components: {
    FooterComponent,
    BannerComponent,
    TitleComponent,
    TabsComponent
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
