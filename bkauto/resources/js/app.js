import './bootstrap';
// bootstrap import
import '../sass/app.scss'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { library } from '@fortawesome/fontawesome-svg-core';
import { fas } from '@fortawesome/free-solid-svg-icons'
library.add(fas);

import * as Vue from "vue";

// Root App
import App from "./App.vue";

// Vue Router
import router from "./router/index";

// Vuex Store
import store from "./store/index";

import Vue3Html2pdf from 'vue3-html2pdf'
// Initial Setup -> You can emit an actions from store to load the data

// root app instance
const app = Vue.createApp(App);

// app.component('todos', require('./components/TodoComponent.vue').default)

// Mountin an app
app.component('fa', FontAwesomeIcon).use(store).use(router).use(Vue3Html2pdf).mount("#app");


