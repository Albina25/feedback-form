import Vue from 'vue'
import App from './App.vue'

Vue.config.productionTip = false
import VModal from 'vue-js-modal'
Vue.use(VModal, {
  dynamicDefaults: {
    draggable: true,
    resizable: true,
    height: 'auto'
  }
})

import VueSweetalert2 from 'vue-sweetalert2'
import Swal from 'sweetalert2'
window.Swal = Swal
Vue.use(VueSweetalert2)


import VueTheMask from 'vue-the-mask'
Vue.use(VueTheMask)

import '@/fontawesome/css/all.css'


new Vue({
  render: h => h(App),
}).$mount('#app')
