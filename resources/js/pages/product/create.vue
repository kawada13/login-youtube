<template>
  <div>
    
    <v-card color="grey lighten-2">
      <div class="justify-space-around d-flex">
       <v-card-title>Create Product</v-card-title>
       <v-card-title>
         <v-btn
          outlined
          rounded
          color="primary"
          @click="$router.push({ name: 'product-list' })"
          >
          product-list
          </v-btn>
       </v-card-title>

      </div>
    </v-card>

    <div class="mt-4" v-show="!loading">
      <v-form ref="form" @submit.prevent='upload'>
        <v-text-field 
          placeholder="Product title" 
          v-model="product.title"
          :rules="[formRules.required]"
         >
         </v-text-field>
        <v-text-field 
          placeholder="Product price" 
          v-model="product.price"
          type="number"
          :rules="[formRules.required]"
         >
         </v-text-field>
        <v-text-field 
          placeholder="Product image" 
          v-model="product.image"
         >
         </v-text-field>
        <v-text-field 
          placeholder="Product description" 
          v-model="product.description"
         >
         </v-text-field>
        <v-btn color="green darken-1" dark type="submit">Create Product</v-btn>
      </v-form>
    </div>

    <div v-show="error">
      すでに登録されている名前です
    </div>

      <Snackbar />

  </div>
</template>

<script>
import Loader from '../../components/Loader.vue'

import { mapState, mapActions } from "vuex"


export default {
  data() {
    return {
      loading: false,
      product: {
        title: '',
        price: null,
        imageUrl: '',
        description: ''
      }
    }
  },
  components: {
    Loader
  },
  methods: {
    async upload() {
      this.loading = false

      if (!this.$refs.form.validate()) {
          this.loading = false
          return
        }

       await this.$store.dispatch('product/create')

       if(this.apiStatus) {
         this.$store.dispatch('snackbar/setSnackMessage', '保存しました。')
         this.$store.dispatch('product/resetCreateName')
         this.$store.dispatch('error/setDupError', false)
         this.$refs.form.resetValidation()
       } else {
         this.$store.dispatch('snackbar/setSnackMessage', '入力形式に不適切な箇所があり保存できません。')
         this.$store.dispatch('error/setDupError', true)
       }

       this.snackOn()

       this.loading = false
    },
    ...mapActions(
      "snackbar",
      {
        snackOn: 'snackOn',
        // setSnackMessage(dispatch) { dispatch("setMessage", this.message) },
      }
    ),
  },
  computed: {
    ...mapState(
      "product",
      { apiStatus: state => state.apiStatus }
    ),
    // apiStatus () {
    //   return this.$store.state.product.apiStatus
    // },
    // title: {
    //   get(){
    //     return this.$store.state.goods.title
    //   },
    //   set(val) {
    //     return this.$store.dispatch('goods/setProduct', val)
    //   }
    // },
    error: {
      get(){
        return this.$store.state.error.duplication
      },
      set(val) {
        return this.$store.state.error.duplication
      }
    },
  },
  mounted() {
      this.loading = true
      this.$store.dispatch('error/setDupError', false)
      this.$refs.form.resetValidation()
      this.loading = false
    }

}
</script>

<style>

</style>