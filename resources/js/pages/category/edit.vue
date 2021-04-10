<template>
  <div>
    <v-card color="grey lighten-2">
      <div class="justify-space-around d-flex">
       <v-card-title>Edit Category</v-card-title>
       <v-card-title>
         <v-btn
          outlined
          rounded
          color="primary"
          @click="$router.push({ name: 'category-list' })"
          >
          category-list
          </v-btn>
       </v-card-title>

      </div>
    </v-card>

    <div class="mt-4" v-show="!loading">
      <v-form ref="form" @submit.prevent='upload'>
        <v-text-field
          placeholder="Category name"
          v-model="CategoryName"
          :rules="[formRules.required]"
         >
         </v-text-field>
        <v-btn color="green darken-1" dark type="submit">Update Category</v-btn>
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
      let id = this.$route.params.id
       await this.$store.dispatch('product/update', id)

       if(this.apiStatus) {
         this.$store.dispatch('snackbar/setSnackMessage', '保存しました。')
         this.$store.dispatch('product/setError', false)
         this.$refs.form.resetValidation()
       } else {
         this.$store.dispatch('snackbar/setSnackMessage', '入力形式に不適切な箇所があり保存できません。')
         this.$store.dispatch('product/setError', true)
       }
       this.snackOn()
       this.loading = false
    },
    ...mapActions(
      "snackbar",
      {
        snackOn: 'snackOn',
        setSnackMessage(dispatch) { dispatch("setMessage", this.message) },
      }
    ),
    async loadCategory() {
        let id = this.$route.params.id

        await this.$store.dispatch('product/loadCategory', id)
     },
  },
  computed: {
    ...mapState(
      "product",
      { apiStatus: state => state.apiStatus }
    ),
    CategoryName: {
      get(){
        return this.$store.state.product.Category.name
      },
      set(val) {
        return this.$store.dispatch('product/editCategory', val)
      }
    },
    error: {
      get(){
        return this.$store.state.product.error
      },
      set(val) {
        return this.$store.state.product.error
      }
    },
  },
  mounted() {
      this.loading = true
      this.$store.dispatch('product/setError', false)
      Promise.all([
        this.loadCategory()
      ])
      this.loading = false
    }

}
</script>

<style>

</style>