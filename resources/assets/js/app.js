
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.DrpImg = require('./res/dropzone');
// window.Cookie = require('js-cookie');
 window.formatDate = require('date-fns/format')
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */ 
// import HotelDatePicker from 'vue-hotel-datepicker';

Vue.component('datepickercalendar', require('./components/HotelDatePicker/components/DatePicker.vue')); 
Vue.component('cityinput-component', require('./components/cityInput.vue')); 

Vue.component('roomsselect-component', require('./components/roomSelect.vue')); 
Vue.component('dropdown-component', require('./components/VisDropdown.vue')); 


Vue.component('example-component', require('./components/ExampleComponent.vue')); 
Vue.component('search-component', require('./components/SearchComponent.vue'));

Vue.component('roombooking-cmp',require('./components/RoomBooking.vue'));

Vue.component('searchresult-component', require('./components/SearchResultComponent.vue') );

Vue.component('payment-component', require('./components/PaymentComponent.vue'));



const app = new Vue({ 
    el: '#__vis_app',
});
 


var search = new Vue({
	el: '#__search',  
});

const _pay_S= new Vue({
    el: '#_pay_pg',
 
});

 

