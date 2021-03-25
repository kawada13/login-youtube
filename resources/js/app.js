import './bootstrap'
import Vue from 'vue';
import Vuetify from './plugins/vuetify' // vuetify.jsを読み込み
import routes from './router/index'

Vue.component('app-header', require('./components/Header.vue').default);


const app = new Vue({
    el: '#app',
    vuetify: Vuetify,
    router:routes
});