<template>
  <v-card width="400px" class="mx-auto mt-5">
    <v-card-title>
      <h1 class="display-1">ユーザー登録</h1>
    </v-card-title>
    <v-card-text>
      <v-form @submit.prevent='login' ref="form">
        <v-text-field 
          prepend-icon="mdi-account-circle" 
          label="お名前"
          :rules="[formRules.required]"
          v-model="loginInfo.name"
          />
        <v-text-field 
        <v-text-field 
          prepend-icon="mdi-account-circle" 
          label="メールアドレス"
          :rules="[formRules.required]"
          v-model="loginInfo.email"
          />
        <v-text-field 
          prepend-icon="mdi-lock" 
          append-icon="mdi-eye-off" 
          label="パスワード" 
          :rules="[formRules.required]"
          v-model="loginInfo.password"
          />
          <v-card-actions>
            <v-btn class="info" type="submit">登録</v-btn>
          </v-card-actions>
      </v-form>
    </v-card-text>
  </v-card>
</template>

<script>
import { mapState, mapActions } from "vuex"

export default {
  data() {
    return {
      loginInfo: {
        name:'',
        email: '',
        password: ''
      }
    }
  },
  methods: {
    ...mapActions(
      "login",
      {
        login(dispatch) { dispatch("login", this.loginInfo)},
      }
    ),
  }

}
</script>

<style>

</style>