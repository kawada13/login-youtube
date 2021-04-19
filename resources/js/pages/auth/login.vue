<template>
  <v-card width="400px" class="mx-auto mt-5">
    <v-card-title>
      <h1 class="display-1">ログイン</h1>
    </v-card-title>
    <v-card-text>
      <v-form>
        <v-text-field 
          prepend-icon="mdi-account-circle" 
          label="ユーザ名"
          :rules="[formRules.required]"
          />
        <v-text-field 
          prepend-icon="mdi-lock" 
          append-icon="mdi-eye-off" 
          label="パスワード" 
          :rules="[formRules.required]"
          />
      </v-form>
    </v-card-text>
    <v-card-actions>
      <v-btn class="info">ログイン</v-btn>
    </v-card-actions>
  </v-card>
</template>

<script>
export default {

}
</script>

<style>

</style>