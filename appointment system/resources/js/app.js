/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
Vue.use(require('vue-resource'));

require('./bootstrap');

window.Vue = require('vue');

import Vue from 'vue'
import VueMask from 'v-mask'
import VueSocketIO from 'vue-socket.io';

Vue.use(VueMask)


Vue.use(new VueSocketIO({
    connection:`http://localhost:3000`
}))

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

Vue.component('admin-front',require('./components/Admin/AdminFront').default);
Vue.component('admin-component',require('./components/Admin/AdminComponent').default);
Vue.component('today-appointment',require('./components/Admin/AdminTodayAppointment').default);
Vue.component('list-component',require('./components/Admin/AdminListAppointment').default);
Vue.component('past-component',require('./components/Admin/AdminPastComponent').default);
Vue.component('appointment-wait',require('./components/Admin/AppointmentWait').default);
Vue.component('appointment-cancel',require('./components/Admin/CancelAppointment').default);
Vue.component('admin-workinghour',require('./components/Admin/AdminWorking').default);
Vue.component('admin-working-item',require('./components/Admin/AdminWorkingHourItem').default);
Vue.component('admin-modal',require('./components/Admin/AdminAppointmentModal').default);
Vue.component('randevu-detail',require('./components/RandevuDetailComponent').default);

Vue.component('pagination',require('laravel-vue-pagination'));

Vue.component('randevu-form',require('./components/RandevuForm').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
