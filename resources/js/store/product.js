import Axios from "axios"

const state = {
  createName: '',
  error: false,
  apiStatus: null,
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
}

const actions = {

  async create({commit, state}, ) {

    await axios.post('/api/category', {name: state.createName})
    .then(res => {
      commit("setApiStatus", true);
      return false;
    })
    .catch(e => {
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