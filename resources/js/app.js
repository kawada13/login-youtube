import './bootstrap'
import Vue from 'vue';
import Vuetify from './plugins/vuetify' // vuetify.jsを読み込み
import validation from './plugins/validation' // validation.jsを読み込み
import routes from './router/index'
import store from './store' 


// グローバルコンポーネント
Vue.component('app-header', require('./components/Header.vue').default);
Vue.component('Snackbar', require('./components/Snackbar.vue').default);


Vue.use(validation)


const app = new Vue({
    el: '#app',
    vuetify: Vuetify,
    router:routes,
    store,
});