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
    // const res = await axios.post('/api/category', {name: state.createName})
    // console.log(res.status);
    // if(res.status === 200) {
    //   commit("setApiStatus", true);
    //   return false;
    //  }
    //  console.log("きた");
    // commit("setApiStatus", false);

    await axios.post('/api/category', {name: state.createName})
    .then(res => {
      console.log(111);
      commit("setApiStatus", true);
      return false;
    })
    .catch(e => {
      console.log(222);
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