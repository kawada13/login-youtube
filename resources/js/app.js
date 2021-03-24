
require('./bootstrap');

import './bootstrap'
import Vue from 'vue';
import Vuetify from './plugins/vuetify' // vuetify.jsを読み込み

import ExampleComponent from './components/ExampleComponent.vue'

const app = new Vue({
    el: '#app',
    vuetify: Vuetify,
    components: {
        ExampleComponent,
    }
});