import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'
import SaveContents from '../views/SaveContents.vue'
import History from '../views/History.vue'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home,
  },
  {
    path: '/save-contents',
    name: 'SaveContents',
    component: SaveContents
  },
  {
    path: '/history',
    name: 'History',
    component: History
  },
  // {
  //   path: '/about',
  //   name: 'About',
  //   // route level code-splitting
  //   // this generates a separate chunk (about.[hash].js) for this route
  //   // which is lazy-loaded when the route is visited.
  //   component: () => import(/* webpackChunkName: "about" */ '../views/About.vue')
  // },
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
