import Vue from 'vue'
import Vuex from 'vuex'
import App from './App.vue'
import router from './router'
import axios from 'axios'
import VueAxios from 'vue-axios'
import util from './util/util'
import "./registerServiceWorker"
import vuetify from './plugins/vuetify'
import Vue2TouchEvents from 'vue2-touch-events'

Vue.config.productionTip = false

Vue.use(VueAxios,axios);
Vue.use(Vuex);
Vue.use(Vue2TouchEvents, {
  namespace: 'my-touch'
});
Vue.mixin(util);

const store = new Vuex.Store({
  state: {
    tab: 1,
  },
  mutations: {
    changeTab(state, tab) {
      state.tab = tab
    }
  },
})

new Vue({
  router,
  vuetify,
  store,
  render: h => h(App)
}).$mount('#app')
