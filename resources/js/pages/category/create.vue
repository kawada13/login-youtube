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
      <v-form ref="form" @submit.prevent>
        <v-text-field placeholder="Category name"></v-text-field>
        <v-btn color="green darken-1" dark @click="upload">Create Category</v-btn>
      </v-form>
    </div>

    <v-btn color="primary" dark @click="load" class="mt-5">Load</v-btn>

    <div v-show="loading">
      <Loader />
    </div>
    
  </div>
</template>

<script>
import Loader from '../../components/Loader.vue'

export default {
  data() {
    return {
      loading: false
    }
  },
  components: {
    Loader
  },
  methods: {
    upload() {
      console.log(111);
    },
    load() {
      this.loading = !this.loading
    }
  }

}
</script>

<style>

</style>