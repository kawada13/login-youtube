
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
  async login({commit}, loginInfo) {
    await axios.get('/sanctum/csrf-cookie').then(response => {
      // ログイン処理…
      console.log(response);
      console.log(loginInfo);
   });
  },
}



export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
}