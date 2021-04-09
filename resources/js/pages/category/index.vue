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
        @click="$router.push({ name: 'create-category' })"
      >
        Create Category
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
              Name
            </th>
            <th class="text-left">
              slug
            </th>
            <th class="text-left">
              Action
            </th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="(item, index) in categories"
            :key="item.name"
          >
            <td>{{ index + 1 }}</td>
            <td>{{ item.name }}</td>
            <td>{{ item.slug }}</td>
            <td>
              <v-btn
                depressed
                color="primary"
                @click="$router.push({ name: 'edit-category', params: { slug: item.slug } })"
              >
                Edit
              </v-btn>
              <v-btn
                depressed
                color="error"
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
        "product",
        { categories: state => state.categories }
      ),
    },
    methods: {
      async loadCategories() {
        await this.$store.dispatch('product/loadCategories')
      },
    },
    mounted() {
      this.loading = true
      Promise.all([
        this.loadCategories()
      ])
      this.loading = false
    }
   }
</script>