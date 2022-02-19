<template>
  <v-app id="app">
    <div id="nav">
      <h1>Qiitaランキング</h1>
    </div>

    <router-view/>
    <div>
      <v-card>
        <v-tabs
          v-model="tab"
          background-color="deep-purple accent-4"
          centered
          dark
          icons-and-text
        >
          <v-tabs-slider></v-tabs-slider>

          <v-tab to="/">
            home
            <v-icon>mdi-phone</v-icon>
          </v-tab>

          <v-tab to="/save-contents">
            後で見る
            <v-icon>mdi-heart</v-icon>
          </v-tab>

          <v-tab to="/history">
            history
            <v-icon>mdi-account-box</v-icon>
          </v-tab>
        </v-tabs>

        <v-tabs-items v-model="tab">
          <v-tab-item
            v-for="i in 3"
            :key="i"
            :value="'tab-' + i"
          >
            <v-card flat>
              <v-card-text>{{ text }}</v-card-text>
            </v-card>
          </v-tab-item>
        </v-tabs-items>
      </v-card>

    </div>
    <div>
      <v-bottom-nav
        absolute
      >
        <router-link to="/">
          home
        </router-link>
        <router-link to="/save-contents">
          後で見る
        </router-link>
      </v-bottom-nav>
    </div>
    <Footer />
  </v-app>
</template>

<script>
import Footer from '@/components/Footer.vue'
export default {
  components: {
    Footer
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
