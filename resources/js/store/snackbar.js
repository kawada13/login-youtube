
const state = {
  isSaved: false,
  message: '',
}

const getters = {}

const mutations = {
  ableSaved(state) {
    state.isSaved = true
  },
  disableSaved(state) {
    state.isSaved = false
  },
  setMessage(state, message) {
    state.message = message
  }
}

const actions = {
  snackOn({ commit }) {
    commit("ableSaved")
  },
  snackOff({ commit }) {
    commit("disableSaved")
  },
  setSnackMessage({commit}, message) {
    commit('setMessage', message)
  }
}



export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
}