import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import Home from '../components/HomeComponent.vue'

const routes = new VueRouter({
  mode:'history',
  routes: [
    {
      path: '/',
      component: Home
    }
  ]
})

export default routes;
