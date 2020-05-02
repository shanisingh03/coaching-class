
require('./bootstrap');

window.Vue = require('vue');

import Vuelidate from 'vuelidate';
Vue.use(Vuelidate);


/**
 * Import Components
 */
// Vue.component('list-institute', require('./components/ExampleComponent.vue').default);
Vue.component('list-institute', require('./components/institute/ListInstitute.vue').default);
Vue.component('add-institute', require('./components/institute/AddInstitute.vue').default);

/**
 * Import File Upload
 */
const VueUploadComponent = require('vue-upload-component');
Vue.component('file-upload', VueUploadComponent);

// Vue.use(require('vue-moment'),{
//     moment
// });

/**
 * Import Sweat alert
 */
import Swal from "sweetalert2";
window.swal = Swal;

/**
 * Import Toaster
 */
import Toasted from 'vue-toasted';
Vue.use(Toasted)


/**
 * Import V Calender
 */
import VCalendar from 'v-calendar';
Vue.use(VCalendar);

window.Fire = new Vue();
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
