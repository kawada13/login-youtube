export default {
  install(vue){   
    console.log('Installing validation plugin..')
    vue.mixin({
      computed: {
        formRules: {
          get() {
            return {
              required: v => !!v || 'この項目は必須です',
            }
          }
        }
      }
    })
  }
}