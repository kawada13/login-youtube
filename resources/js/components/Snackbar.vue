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
        console.log(22);
        return this.$store.state.snackbar.isSaved
      },
      set() {
        console.log(11);
        return this.$store.dispatch('snackbar/snackOff')
      }
    }
   },
  }
</script>