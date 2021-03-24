import './bootstrap'
import Vue from 'vue';
import Vuetify from './plugins/vuetify' // vuetify.jsを読み込み
import routes from './router/index'


const app = new Vue({
    el: '#app',
    vuetify: Vuetify,
    router:routes
});