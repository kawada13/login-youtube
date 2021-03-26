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

    <v-btn color="primary" dark @click="load" class="mt-5">Load</v-btn>

    <div v-show="loading">
      <Loader />
    </div>
    <div v-show="error">
      すでに登録されている名前です
    </div>


   <!-- <div v-show="isSaved"> -->
     <Snackbar 
     :isSaved='isSaved'
     :message='message'
     />
   <!-- </div> -->

    
  </div>
</template>

<script>
import Loader from '../../components/Loader.vue'

export default {
  data() {
    return {
      loading: false,
      createName:'',
      error: false,
      message: '',
      isSaved: false
    }
  },
  components: {
    Loader
  },
  methods: {
    upload() {
      this.error = false

      if (!this.$refs.form.validate()) return

      if (this.$refs.form.validate()) {
        axios.post('/api/category', {name: this.createName})
        .then(res => {
          console.log(res);
          this.createName = '';
          this.message = '保存しました'
          this.isSaved = true
          this.$refs.form.resetValidation()
        })
        .catch(e => {
            console.log(e.response.status)
            if(e.response.status == 500) {
              this.error = true
              this.message = '入力形式に不適切な箇所があり保存できません。'
              this.isSaved = true
            }
        })
        // .finally(() => {
        //   this.isSaved = false
        // });
      }
      
    },
    load() {
      this.loading = !this.loading
    }
  }

}
</script>

<style>

</style>