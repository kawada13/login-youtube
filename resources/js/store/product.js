import Axios from "axios"

const state = {
  createName: '',
  error: false,
  apiStatus: null,
  categories: []
}

const getters = {}

const mutations = {
  setCreateName(state, val) {
    state.createName = val
  },
  resetCreateName(state) {
    state.createName = ''
  },
  setError(state, judge) {
    state.error = judge
  },
  setApiStatus(state, status) {
    state.apiStatus = status;
 },
  setCategories(state, lists) {
    state.categories = [],
    state.categories.push(...lists)
  }
}

const actions = {

  async create({commit, state}, ) {

    await axios.post('/api/category', {name: state.createName})
    .then(res => {
      console.log(res);
      commit("setApiStatus", true);
      return false;
    })
    .catch(e => {
      console.log(e.response);
      commit("setApiStatus", false);
    })
  },

  async loadCategories({commit}) {
    await axios.get('/api/category')
    .then(res => {
      console.log(res.data.category_list);
      commit("setApiStatus", true);
      commit("setCategories", res.data.category_list);
    })
    .catch(e => {
      console.log(e.response);
      commit("setApiStatus", false);
    })

  },

  setError({commit}, judge) {
    commit("setError", judge);
  },
  resetCreateName({commit}) {
    commit('resetCreateName')
  },
  setCreateName({commit}, val) {
    commit('setCreateName', val)
  }
}

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
}