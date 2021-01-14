/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import swal from 'sweetalert';
import VueLocalStorage from 'vue-localstorage';
import VueCookies from 'vue-cookies';
import VueLang from '@eli5/vue-lang-js';
import moment from 'moment';
// get the data source
import translations from './vue-translations.js';
import VoerroTagsInput from '@voerro/vue-tagsinput';
import VCalendar from 'v-calendar';
var Vue = require('vue');
require('lang.js');

Vue.use(VCalendar, {
  componentPrefix: 'vc',  // Use <vc-calendar /> instead of <v-calendar />
  locales: {
   'pt-PT': {
     firstDayOfWeek: 1,
     masks: {
       L: 'YYYY-MM-DD',
       // ...optional `title`, `weekdays`, `navMonths`, etc
     }
   }
 },
                 // ...other defaults
});

Vue.use(VueLang, {
  messages: translations, // Provide locale file
  //locale: 'es', // Set locale
  fallback: 'en' // Set fallback lacale
});
Vue.use(require('vue-cookies'));
Vue.use(VueLocalStorage);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('tags-input', VoerroTagsInput);
Vue.component('keys-input', VoerroTagsInput);
Vue.component('keywords-input', VoerroTagsInput);
Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('cont-view-share-like-component', require('./components/forms/ContViewShareLikeComponent.vue').default);
Vue.component('reservar-hostal-component', require('./components/forms/ReservarHostalComponent.vue').default);
Vue.component('contacto-hostal-component', require('./components/forms/ContactoHostalComponent.vue').default);
Vue.component('reservado-hostal-component', require('./components/forms/ReservadoHostalComponent.vue').default);
Vue.component('newsletter-component', require('./components/forms/NewsletterComponent.vue').default);
Vue.component('login-form-component', require('./components/forms/auth/LoginFormComponent.vue').default);
Vue.component('register-form-component', require('./components/forms/auth/RegisterFormComponent.vue').default);
Vue.component('reset-email-form-component', require('./components/forms/auth/ResetEmailFormComponent.vue').default);
Vue.component('add-post-form-component', require('./components/admin/posts/forms/AddPostFormComponent.vue').default);
Vue.component('edit-post-form-component', require('./components/admin/posts/forms/EditPostFormComponent.vue').default);
Vue.component('index-post-component', require('./components/admin/posts/indexPostComponent.vue').default);
Vue.component('post-ppal-tab-component', require('./components/admin/posts/PostPpalTabComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    props:['id_post','cant_read', 'cant_shares', 'cant_likes'],
    data(){
      return {
        email    : '',
        password:'',
        ventanaLogin:'',
        ventanaContact:'',
        ventanaRegister:'',
        ventanaResetEmail:'',
        ventanaCreatPost:'',
        locale:'en',
        ventanaEditPost:'',
        categories:'',
        token   : window.CSRF_TOKEN,
      }
    },
    methods:{
      resetEmailModal:function(){
        this.ventanaResetEmail=true;
          this.ventanaLogin=false;
      },
      openLoginModal:function(){
        this.ventanaLogin=true;
      },

    },
    mounted(){
      if($cookies.isKey('mostrarModalLogin')===false){
        this.openLoginModal();
        $cookies.set('mostrarModalLogin', 'no', '6h');
      }

      axios.get('/exist-post')
           .then(response =>{
             let cantPost=response.data;
             if(cantPost===0){
          $("#blog").hide(true);
          $("#blog-menu").hide(true);
             }
           });
     /*Vue.localStorage.set('openLogin', 'no');
     if(Vue.localStorage.get('openLogin')==='no'){
     console.log(Vue.localStorage.get('openLogin'));
   }*/
    },
});
