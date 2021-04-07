<template>
  <div class="text-center">

    <v-snackbar
      v-model="snackbarVisible"
      :timeout="timeout"
      color="success"
      outlined
      :top="true"
      :right="true"
    >
      {{ message }}
    </v-snackbar>


  </div>
</template>


<script>

  import { mapState, mapActions } from "vuex"

  export default {
    data: () => ({
      timeout: 1500,
    }),
    computed: {
    ...mapState(
      "snackbar",
      { message: state => state.message },
    ),
    snackbarVisible: {
      get() {
        return this.$store.state.snackbar.isSaved
      },
      set() {
        return this.$store.dispatch('snackbar/snackOff')
        
      }
    }
   },
  }
</script>