
const state = {
  duplication: false,
}

const getters = {}

const mutations = {
  setDupError(state, judge) {
    state.duplication = judge
  },
}

const actions = {
  setDupError({commit}, judge) {
    commit("setDupError", judge);
  },
}



export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
}