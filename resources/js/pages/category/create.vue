<template>
  <div>
    
    <v-card color="grey lighten-2">
      <div class="justify-space-around d-flex">
       <v-card-title>Product Category</v-card-title>
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
          v-model="createName"
          :rules="[formRules.required]"
         >
         </v-text-field>
        <v-btn color="green darken-1" dark type="submit">Create Category</v-btn>
      </v-form>
    </div>


    <div v-show="loading">
      <Loader />
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
      createName:'',
      error: false,
      message: '',
    }
  },
  components: {
    Loader
  },
  methods: {
    upload() {
      this.error = false
      this.loading = true

      if (!this.$refs.form.validate()) {
          this.loading = false
          return
        }

      if (this.$refs.form.validate()) {
        axios.post('/api/category', {name: this.createName})
        .then(res => {
          console.log(res);
          this.createName = '';
          this.message = '保存しました'
          // バリデーションエラー解除
          this.$refs.form.resetValidation()
        })
        .catch(e => {
            console.log(e.response.status)
            if(e.response.status == 500) {
              this.error = true
              this.message = '入力形式に不適切な箇所があり保存できません。'
            }
        })
        .finally(() => {
          this.setMessage()
          this.snackOn()
          this.loading = false
        });
      }
    },
    ...mapActions(
      "snackbar", 
      {
        snackOn: 'snackOn',
        setMessage(dispatch) { dispatch("setMessage", this.message) },
      }
    ),
  },

}
</script>

<style>

</style>