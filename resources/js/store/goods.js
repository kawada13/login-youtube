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
    state.Product = val
  },
  editProduct(state, categoryName) {
    state.Product.name = categoryName
  }
}

const actions = {

  async create({commit, state}, product) {

    console.log(product);
    await axios.post('/api/product', product)
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
  async update({commit, state}, product) {
    // console.log(product);
    await axios.put(`/api/product/${product.id}`, {
      'title': product.title,
      'price': product.price,
      'description': product.description,
      'category_id': product.category_id,
    })
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
      // console.log(res.data.product_list);
      commit("setApiStatus", true);
      commit("loadProducts", res.data.product_list);
    })
    .catch(e => {
      console.log(e.response);
      commit("setApiStatus", false);
    })

  },
  async loadProduct({commit}, id) {
    await axios.get(`/api/product/${id}/edit`)
    .then(res => {
      // console.log(res.data);
      commit("setProduct", res.data.product);
    })
    .catch(e => {
      console.log(e.response);
    })
  },

  async deleteProduct({commit}, id) {
    await axios.delete(`/api/product/${id}`)
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