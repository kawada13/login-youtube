<template>
  <div>

    <v-card color="grey lighten-2">
      <div class="justify-space-around d-flex">
       <v-card-title>Product List</v-card-title>
       <v-card-title>
         <v-btn
        outlined
        rounded
        color="primary"
        @click="$router.push({ name: 'create-product' })"
      >
        Create Product
      </v-btn>
         </v-card-title>
      </div>
    </v-card>

    <v-simple-table v-show="!loading">
      <template v-slot:default>
        <thead>
          <tr>
            <th class="text-left">
              ID
            </th>
            <th class="text-left">
              Title
            </th>
            <th class="text-left">
              slug
            </th>
            <th class="text-left">
              price
            </th>
            <th class="text-left">
              Description
            </th>
            <th class="text-left">
              Action
            </th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="(item, index) in products"
            :key="item.name"
          >
            <td>{{ index + 1 }}</td>
            <td>{{ item.name }}</td>
            <td>{{ item.slug }}</td>
            <td>
              <v-btn
                depressed
                color="primary"
                @click="$router.push({ name: 'edit-product', params: { id: item.id } })"
              >
                Edit
              </v-btn>
              <v-btn
                depressed
                color="error"
                @click="deleteProduct(item.id)"
              >
                Delete
              </v-btn>
            </td>
          </tr>
        </tbody>
      </template>
    </v-simple-table>
    <div v-show="loading">
      <Loader />
    </div>
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
    computed: {
        ...mapState(
        "goods",
        { products: state => state.products }
      ),
    },
    methods: {
      async loadProducts() {
        await this.$store.dispatch('goods/loadProducts')
      },
      async deleteProduct(id) {
        let result = confirm('本当に削除しますか');

        if(result){
          await this.$store.dispatch('product/deleteProduct', id)
        　this.loadProducts()
        }else{
          console.log('削除をとりやめました');
        }
      }
    },
    mounted() {
      this.loading = true
      Promise.all([
        this.loadProducts()
      ])
      this.loading = false
    }
   }
</script>