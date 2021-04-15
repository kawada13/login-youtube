<template>
  <div>
    <v-card color="grey lighten-2">
      <div class="justify-space-around d-flex">
       <v-card-title>Edit Product</v-card-title>
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
        <v-select
          item-text="name"
          item-value="id"
          :items="categories"
          label="カテゴリーを選択してください"
          v-model="product.category_id"
          :rules="[formRules.required]"
        ></v-select>
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
          placeholder="Product description" 
          v-model="product.description"
         >
         </v-text-field>
        <v-btn color="green darken-1" dark type="submit">Update Product</v-btn>
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
        // imageUrl: '',
        description: '',
        category_id: this.$route.params.id
      }
    }
  },
  components: {
    Loader
  },
  methods: {
    async loadCategories() {
        await this.$store.dispatch('product/loadCategories')
      },
    async loadProduct() {
        let id = this.$route.params.id
        await this.$store.dispatch('goods/loadProduct', id)
        this.product = this.$store.state.goods.Product
      },
    async upload() {
      this.loading = false

      if (!this.$refs.form.validate()) {
          this.loading = false
          return
        }
        console.log(this.product);

       await this.$store.dispatch('goods/update', this.product)

       if(this.apiStatus) {
         this.$store.dispatch('snackbar/setSnackMessage', '保存しました。')
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
    resetData() {
      this.product.title = ''
      this.product.price = null
      this.product.description = ''
      this.product.category_id = null
    }
  },
  computed: {
    ...mapState(
        "product",
        { categories: state => state.categories }
      ),
    ...mapState(
      "goods",
      { apiStatus: state => state.apiStatus }
    ),
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
      Promise.all([
        this.loadProduct(),
        this.loadCategories()
      ])
      this.$store.dispatch('error/setDupError', false)
      this.$refs.form.resetValidation()
      this.loading = false
    }

}
</script>

<style>

</style>