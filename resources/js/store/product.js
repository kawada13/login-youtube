import Axios from "axios"

const state = {
  createName: '',
  error: false,
  apiStatus: null,
  categories: [],
  Category: ''
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
  },
  setCategory(state, category) {
    state.Category = category
  },
  editCategory(state, categoryName) {
    state.Category.name = categoryName
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
  async update({commit, state}, id) {

    await axios.put(`/api/category/${id}`, {name: state.Category.name})
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
      // console.log(res.data.category_list);
      commit("setApiStatus", true);
      commit("setCategories", res.data.category_list);
    })
    .catch(e => {
      console.log(e.response);
      commit("setApiStatus", false);
    })

  },
  async loadCategory({commit}, id) {
    await axios.get(`/api/category/${id}/edit`)
    .then(res => {
      // console.log(res.data.category);
      commit("setCategory", res.data.category);
    })
    .catch(e => {
      console.log(e.response);
    })
  },

  async deleteCategory({commit}, id) {
    await axios.delete(`/api/category/${id}`)
    .then(res => {
      // console.log(res);
    })
    .catch(e => {
      // console.log(e.response);
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
  },
  editCategory({commit}, val) {
    console.log(val);
    commit('editCategory', val)
  },
  
}

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
}