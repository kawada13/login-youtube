<template>
  <div class="text-center">
    <!-- <v-btn
      dark
      color="orange darken-2"
      @click="snackbar = true"
    >
      Open Snackbar
    </v-btn> -->

    <v-snackbar
      v-model="isSaved"
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
  export default {
    props: {
      isSaved: {
        type: Boolean,
        default: false,
        required: true
      },
      message: {
        type: String,
        default: '',
        required: true
      }
    },
    data: () => ({
      timeout: 1500,
    }),
  }
</script>