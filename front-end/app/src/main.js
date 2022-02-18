import Vue from 'vue'
import Vuex from 'vuex'
import App from './App.vue'
import router from './router'
import axios from 'axios'
import VueAxios from 'vue-axios'
import util from './util/util'
import "./registerServiceWorker"
import vuetify from './plugins/vuetify'
import '@babel/polyfill'

Vue.config.productionTip = false

Vue.use(VueAxios,axios);
Vue.use(Vuex);
Vue.mixin(util);

new Vue({
  router,
  vuetify,
  render: h => h(App)
}).$mount('#app')
