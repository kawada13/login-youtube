import Axios from "axios"

const state = {
  title: '',
  price: null,
  imageUrl: '',
  description: '',
  apiStatus: null,
  products: [],
  Product: {}
}

const getters = {}

const mutations = {
  setTitle(state, val) {
    state.createName = val
  },
  reset(state) {
    state.title = ''
    state.price = null
    state.imageUrl = ''
    state.description = ''
  },
  setApiStatus(state, status) {
    state.apiStatus = status;
 },
  loadProducts(state, lists) {
    state.products = [],
    state.products.push(...lists)
  },
  setProduct(state, val) {
    state.Product = category
  },
  editProduct(state, categoryName) {
    state.Product.name = categoryName
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

    await axios.put(`/api/category/${id}`, {name: state.Product.name})
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

  async loadProducts({commit}) {
    await axios.get('/api/product')
    .then(res => {
      // console.log(res.data.category_list);
      commit("setApiStatus", true);
      commit("loadProducts", res.data.product_list);
    })
    .catch(e => {
      console.log(e.response);
      commit("setApiStatus", false);
    })

  },
  async loadProduct({commit}, id) {
    await axios.get(`/api/category/${id}/edit`)
    .then(res => {
      // console.log(res.data.category);
      commit("setProduct", res.data.category);
    })
    .catch(e => {
      console.log(e.response);
    })
  },

  async deleteProduct({commit}, id) {
    await axios.delete(`/api/category/${id}`)
    .then(res => {
      // console.log(res);
    })
    .catch(e => {
      // console.log(e.response);
    })

  },

  reset({commit}) {
    commit('reset')
  },
  setProduct({commit}, val) {
    // console.log(val);
    commit('setProduct', val)
  },
  editProduct({commit}, val) {
    console.log(val);
    commit('editProduct', val)
  },
  
}

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
}