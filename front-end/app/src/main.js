import Vue from 'vue'
import Vuex from 'vuex'
import App from './App.vue'
import router from './router'
import axios from 'axios'
import VueAxios from 'vue-axios'
import util from './util/util'
import "./registerServiceWorker"

Vue.config.productionTip = false

Vue.use(VueAxios,axios);
Vue.use(Vuex);
Vue.mixin(util);

new Vue({
  router,
  render: h => h(App)
}).$mount('#app')
