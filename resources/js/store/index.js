import Vue from 'vue'
import Vuex from 'vuex'

import product from './product'
import snackbar from './snackbar'

Vue.use(Vuex)

const store = new Vuex.Store({
  modules: {
    product,
    snackbar
  }
})

export default store