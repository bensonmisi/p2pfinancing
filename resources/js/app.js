require('./bootstrap');

require('alpinejs');

import { App, plugin } from '@inertiajs/inertia-vue'
import Vue from 'vue'
import { InertiaProgress } from '@inertiajs/progress'
import vuetify from './Plugins/vuetify'
import moment from 'moment';
Vue.filter('formatDate',function(value){
    if(value){
        return moment(String(value)).format('MM/DD/YYYY hh:mm')
    }
})
Vue.use(plugin)
Vue.prototype.$route = route
const el = document.getElementById('app')
InertiaProgress.init({
    // The delay after which the progress bar will
    // appear during navigation, in milliseconds.
    delay: 250,

    // The color of the progress bar.
    color: '#29d',

    // Whether to include the default NProgress styles.
    includeCSS: true,

    // Whether the NProgress spinner will be shown.
    showSpinner: false,
  })

new Vue({
  vuetify,
  InertiaProgress,
  render: h => h(App, {
    props: {
      initialPage: JSON.parse(el.dataset.page),
      resolveComponent: name => require(`./Pages/${name}`).default,
    },
  }),
}).$mount(el)
