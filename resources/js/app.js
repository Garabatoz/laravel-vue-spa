import Vue from 'vue'
import store from '~/store'
import router from '~/router'
import i18n from '~/plugins/i18n'
import App from '~/components/App'
import { library } from '@fortawesome/fontawesome-svg-core';
import { faArrowDown } from '@fortawesome/free-solid-svg-icons';
import '~/plugins'
import '~/components'

library.add(faArrowDown);


Vue.config.productionTip = false

/* eslint-disable no-new */
new Vue({
  i18n,
  store,
  router,
  ...App
})
