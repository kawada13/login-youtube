import Vue from 'vue'
import Vuex from 'vuex'

import product from './product'
import goods from './goods'
import snackbar from './snackbar'

Vue.use(Vuex)

const store = new Vuex.Store({
  modules: {
    product,
    goods,
    snackbar
  }
})

export default store