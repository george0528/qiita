import { createApp, h } from 'vue';
import { createStore } from 'vuex'
import App from './App.vue'
import router from './router'
import axios from 'axios'
import VueAxios from 'vue-axios'
import util from './util/util'
import "./registerServiceWorker"
import vuetify from './plugins/vuetify'
import Vue2TouchEvents from 'vue2-touch-events'


const store = createStore({
  state: {
    tab: 0,
  },
  mutations: {
    changeTab(state, tab) {
      state.tab = tab
    }
  },
})

const app = createApp({
  render: () => h(App)
}).use(router).use(store).mount('#app')

app.use(vuetify);
app.use(VueAxios,axios);
app.use(Vue2TouchEvents, {
  namespace: 'my-touch'
});
app.mixin(util);